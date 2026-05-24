export default function adminLayout() {
    const savedRead = JSON.parse(localStorage.getItem('admin_read_notifications') || '[]');

    return {
        sidebarOpen: false,
        notificationsOpen: false,
        notifications: [],
        unreadCount: 0,
        knownIds: new Set(),
        readIds: new Set(savedRead),
        pollInterval: null,

        toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen;
        },

        toggleNotifications() {
            this.notificationsOpen = !this.notificationsOpen;
        },

        markAllAsRead() {
            this.notifications.forEach(n => this.readIds.add(n.id));
            localStorage.setItem('admin_read_notifications', JSON.stringify(Array.from(this.readIds)));
            this.unreadCount = 0;
        },

        markAsRead(id) {
            this.readIds.add(id);
            localStorage.setItem('admin_read_notifications', JSON.stringify(Array.from(this.readIds)));
            this.unreadCount = this.notifications.filter(n => !this.readIds.has(n.id)).length;
        },

        isRead(id) {
            return this.readIds.has(id);
        },

        init() {
            // Initial fetch
            this.fetchNotifications(true);
            // Polling every 15 seconds
            this.pollInterval = setInterval(() => {
                this.fetchNotifications(false);
            }, 15000);
        },

        destroy() {
            if (this.pollInterval) {
                clearInterval(this.pollInterval);
            }
        },

        async fetchNotifications(isFirstRun = false) {
            try {
                const response = await fetch('/admin/api/notifications', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (response.ok) {
                    const data = await response.json();
                    
                    let hasNew = false;
                    const fetchedNotifications = data.notifications || [];
                    
                    fetchedNotifications.forEach(notif => {
                        if (!this.knownIds.has(notif.id)) {
                            // If this item is not in knownIds and is NOT marked read, it counts as new
                            if (!isFirstRun && !this.readIds.has(notif.id)) {
                                hasNew = true;
                            }
                            this.knownIds.add(notif.id);
                        }
                    });
                    
                    this.notifications = fetchedNotifications;
                    
                    // Count items that are NOT in readIds
                    const activeUnread = fetchedNotifications.filter(n => !this.readIds.has(n.id)).length;
                    this.unreadCount = activeUnread;

                    if (hasNew && !isFirstRun) {
                        this.playNotificationSound();
                    }
                }
            } catch (error) {
                console.error('Error fetching notifications:', error);
            }
        },

        playNotificationSound() {
            try {
                const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                const now = audioCtx.currentTime;

                // 1. The "Cha" (Drawer Clutter & Coin rattle transient)
                const playClatter = (freq, type, vol, duration) => {
                    const osc = audioCtx.createOscillator();
                    const gain = audioCtx.createGain();
                    const filter = audioCtx.createBiquadFilter();

                    osc.connect(filter);
                    filter.connect(gain);
                    gain.connect(audioCtx.destination);

                    osc.type = type;
                    osc.frequency.setValueAtTime(freq, now);
                    
                    // Add rapid pitch sweep to simulate sliding/tumbling coins
                    osc.frequency.linearRampToValueAtTime(freq * 1.6, now + duration);

                    // Highpass filter to get that crispy, metallic drawer key sound
                    filter.type = 'highpass';
                    filter.frequency.setValueAtTime(1000, now);

                    gain.gain.setValueAtTime(0, now);
                    gain.gain.linearRampToValueAtTime(vol, now + 0.005);
                    gain.gain.exponentialRampToValueAtTime(0.0001, now + duration);

                    osc.start(now);
                    osc.stop(now + duration);
                };

                // Play 3 clattering waves for the realistic mechanical latch release
                playClatter(150, 'sawtooth', 0.10, 0.08); // Lower mechanical sliding drawer
                playClatter(800, 'triangle', 0.12, 0.10); // Mid-pitch metal rattle
                playClatter(2800, 'square', 0.06, 0.12);  // High-pitched coin click

                // 2. The "Ching" (High-Resonant Crystal Bell)
                const playBell = (delay, freq, vol, duration) => {
                    const osc = audioCtx.createOscillator();
                    const gain = audioCtx.createGain();
                    
                    osc.connect(gain);
                    gain.connect(audioCtx.destination);
                    
                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(freq, now + delay);
                    
                    gain.gain.setValueAtTime(0, now + delay);
                    gain.gain.linearRampToValueAtTime(vol, now + delay + 0.002); // Immediate attack
                    gain.gain.exponentialRampToValueAtTime(0.0001, now + delay + duration); // Long, elegant reverb-like decay

                    osc.start(now + delay);
                    osc.stop(now + delay + duration);
                };

                // Elegant Shopify cash bell chime (Fundamental at 2182.8Hz + high octave at 4365.6Hz)
                playBell(0.05, 2182.8, 0.20, 1.4); // Bright bell chime
                playBell(0.05, 4365.6, 0.08, 0.8); // High harmonic accent for that glass shimmer
            } catch (e) {
                console.warn('Audio Context Shopify chime play failed:', e);
            }
        }
    }
}
