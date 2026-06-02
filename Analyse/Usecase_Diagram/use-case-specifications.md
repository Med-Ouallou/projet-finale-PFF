# Use Case Specifications — Restaurant Management System

> UML 2.x compliant specifications for all use cases across Sprint 1, Sprint 2, and Sprint 3.

---

## Table of Contents

- [Actors](#actors)
- [Quick Reference Card](#quick-reference-card)
- [Sprint Mapping](#sprint-mapping)
- [Admin Use Cases](#admin-use-cases) — UC-A1 to UC-A7
- [Employee Use Cases](#employee-use-cases) — UC-E1 to UC-E4
- [Customer Use Cases](#customer-use-cases) — UC-C1 to UC-C6

---

## Actors

| Actor | Description | Auth |
|:------|:------------|:----:|
| **Admin** | Restaurant owner/manager — full system control | Required |
| **Employee** | Restaurant staff (waiter, kitchen) — limited operations | Required |
| **Customer (Guest)** | Unauthenticated — browse menu & contact only | None |
| **Customer (Authenticated)** | Registered — place orders, track, profile, history | Required |

---

## Quick Reference Card

```
<<include>> (mandatory sub-behavior)
  UC-C2 Place Order ──────► UC-C2-INC1 Authenticate
  UC-C2 Place Order ──────► UC-C2-INC2 Calculate Total
  UC-A6 Manage Inventory ─► UC-A6-INC Check Low Stock

<<extend>> (optional/conditional)
  UC-C1-EXT Filter by Category ──► UC-C1 Browse Menu
  UC-C2-EXT1 Order via WhatsApp ─► UC-C2 Place Order  [Sprint 1]
  UC-C2-EXT2 Apply Promotion ────► UC-C2 Place Order  [Sprint 2]
  UC-C2-EXT3 Pay Online ─────────► UC-C2 Place Order  [Sprint 3]
```

---

## Sprint Mapping

| Use Case | Actor | S1 | S2 | S3 |
|:---------|:------|:--:|:--:|:--:|
| UC-A1: Manage Users | Admin | ✅ | | |
| UC-A2: Manage Menus | Admin | ✅ | | |
| UC-A3: Manage Categories | Admin | ✅ | | |
| UC-A4: View Dashboard | Admin | ✅ | | |
| UC-A5: View Revenue Reports | Admin | | ✅ | |
| UC-A6: Manage Inventory | Admin | | ✅ | |
| UC-A7: Manage Promotions | Admin | | ✅ | |
| UC-E1: View Orders | Employee | ✅ | | |
| UC-E2: Update Order Status | Employee | | ✅ | |
| UC-E3: Manage Menu Items | Employee | ✅ | | |
| UC-E4: View Personal Statistics | Employee | ✅ | | |
| UC-C1: Browse Menu | Customer | ✅ | | |
| UC-C2: Place Order | Customer | ✅ | ✅ | ✅ |
| UC-C3: Track Orders | Customer | | ✅ | |
| UC-C4: Manage Profile | Customer | | ✅ | |
| UC-C5: View Order History | Customer | | ✅ | |
| UC-C6: Contact Restaurant | Customer | ✅ | | |

> **UC-C2 Sprint evolution:** S1 = base + WhatsApp · S2 = + Apply Promotion · S3 = + Pay Online

---

# Admin Use Cases

---

## UC-A1: Manage Users

| | |
|:--|:--|
| **ID** | UC-A1 |
| **Actor** | Admin |
| **Sprint** | 1 |
| **Preconditions** | Admin is authenticated |
| **Postconditions** | User list is updated (created, modified, or deleted) |

**Main Flow:**

| Step | Actor | Action |
|:----:|:-----:|:-------|
| 1 | Admin | Selects "Manage Users" from dashboard |
| 2 | System | Displays list of users with roles and status |
| 3 | Admin | Chooses an action (Add / Edit / Delete) |
| 4 | System | Presents the appropriate form |
| 5 | Admin | Fills in user details (name, email, role, status) |
| 6 | System | Validates the input |
| 7 | System | Saves the user record |
| 8 | System | Confirms the operation and refreshes the user list |

**Alternative Flows:**

| Alt | Condition | Flow |
|:----|:----------|:-----|
| 3a | Add User | Admin clicks "Add User" → empty form → continue from step 5 |
| 3b | Edit User | Admin clicks "Edit" → pre-filled form → continue from step 5 |
| 3c | Delete User | Admin clicks "Delete" → confirm → system removes → go to step 8 |
| 6a | Validation Error | System displays error → Admin corrects → return to step 5 |

---

## UC-A2: Manage Menus

| | |
|:--|:--|
| **ID** | UC-A2 |
| **Actor** | Admin |
| **Sprint** | 1 |
| **Preconditions** | Admin is authenticated |
| **Postconditions** | Menu list is updated |

**Main Flow:**

| Step | Actor | Action |
|:----:|:-----:|:-------|
| 1 | Admin | Selects "Manage Menus" from dashboard |
| 2 | System | Displays list of menus with active status and date ranges |
| 3 | Admin | Chooses an action (Add / Edit / Delete / Toggle Active) |
| 4 | System | Presents the appropriate form |
| 5 | Admin | Fills in menu details (name, description, valid_from, valid_until, is_active, currency) |
| 6 | System | Validates the input |
| 7 | System | Saves the menu record |
| 8 | System | Confirms the operation and refreshes the list |

**Alternative Flows:**

| Alt | Condition | Flow |
|:----|:----------|:-----|
| 3d | Toggle Active | Admin toggles is_active flag → go to step 8 |
| 6a | Validation Error | System displays error → Admin corrects → return to step 5 |
| 3c | Delete with Categories | System warns → Admin confirms cascade or cancels |

---

## UC-A3: Manage Categories

| | |
|:--|:--|
| **ID** | UC-A3 |
| **Actor** | Admin |
| **Sprint** | 1 |
| **Preconditions** | Admin is authenticated; at least one menu exists |
| **Postconditions** | Category list is updated |

**Main Flow:**

| Step | Actor | Action |
|:----:|:-----:|:-------|
| 1 | Admin | Selects "Manage Categories" from dashboard |
| 2 | System | Displays categories grouped by menu |
| 3 | Admin | Chooses an action (Add / Edit / Delete) |
| 4 | System | Presents form with menu selector and category fields |
| 5 | Admin | Fills in category details (name, description, parent, display_order, icon, is_active) |
| 6 | System | Validates the input |
| 7 | System | Saves the category record |
| 8 | System | Confirms the operation and refreshes the list |

**Alternative Flows:**

| Alt | Condition | Flow |
|:----|:----------|:-----|
| 5a | Sub-category | Admin selects a parent category → system shows hierarchical position |
| 3c | Delete with Items | System warns that menu items exist → Admin confirms or cancels |

---

## UC-A4: View Dashboard

| | |
|:--|:--|
| **ID** | UC-A4 |
| **Actor** | Admin |
| **Sprint** | 1 |
| **Preconditions** | Admin is authenticated |
| **Postconditions** | Admin has viewed system overview metrics |

**Main Flow:**

| Step | Actor | Action |
|:----:|:-----:|:-------|
| 1 | Admin | Logs in and lands on the dashboard |
| 2 | System | Displays key metrics: today's orders, revenue, active menu items, low stock alerts |
| 3 | Admin | Reviews the summary cards and charts |
| 4 | Admin | May navigate to detailed views from dashboard links |

**Alternative Flows:**

| Alt | Condition | Flow |
|:----|:----------|:-----|
| 2a | No data yet | System displays empty state with onboarding prompts |

---

## UC-A5: View Revenue Reports

| | |
|:--|:--|
| **ID** | UC-A5 |
| **Actor** | Admin |
| **Sprint** | 2 |
| **Preconditions** | Admin is authenticated; order data exists |
| **Postconditions** | Admin has viewed revenue statistics for selected period |

**Main Flow:**

| Step | Actor | Action |
|:----:|:-----:|:-------|
| 1 | Admin | Selects "Reports" from dashboard |
| 2 | System | Displays default report (current month) |
| 3 | Admin | Optionally selects a date range filter |
| 4 | System | Recalculates and displays: total revenue, order count, average order value, top-selling items |
| 5 | Admin | Reviews charts and data tables |

**Alternative Flows:**

| Alt | Condition | Flow |
|:----|:----------|:-----|
| 3a | Custom Period | Admin selects start/end dates → system filters accordingly |
| 3b | Daily View | Admin selects "Daily" → system shows day-by-day breakdown |
| 4a | No Orders in Period | System displays "No data" message with suggestion to expand range |

---

## UC-A6: Manage Inventory

| | |
|:--|:--|
| **ID** | UC-A6 |
| **Actor** | Admin |
| **Sprint** | 2 |
| **Preconditions** | Admin is authenticated |
| **Postconditions** | Inventory records are updated; low stock alerts triggered if applicable |
| **Includes** | `<<include>>` UC-A6-INC: Check Low Stock |

**Main Flow:**

| Step | Actor | Action |
|:----:|:-----:|:-------|
| 1 | Admin | Selects "Manage Inventory" from dashboard |
| 2 | System | Displays inventory items with stock levels and thresholds |
| 3 | Admin | Chooses an action (Add / Edit / Delete / Update Quantity) |
| 4 | System | Presents the appropriate form |
| 5 | Admin | Fills in item details (name, reference, quantity, min_threshold, unit, unit_price) |
| 6 | System | Validates the input |
| 7 | System | Saves the inventory record |
| 8 | System | Executes **Check Low Stock** (included sub-behavior) |
| 9 | System | Confirms the operation and refreshes the list |

**Alternative Flows:**

| Alt | Condition | Flow |
|:----|:----------|:-----|
| 3d | Update Quantity | Admin adjusts quantity (delta +/-) → system updates quantity_in_stock → go to step 7 |
| 8a | Low Stock Detected | System flags items below min_threshold → displays alert on dashboard |

### UC-A6-INC: Check Low Stock *(included sub-behavior)*

| | |
|:--|:--|
| **ID** | UC-A6-INC |
| **Included By** | UC-A6: Manage Inventory |
| **Description** | Checks all inventory items against minimum thresholds and generates alerts |

| Step | Action |
|:----:|:-------|
| 1 | System iterates through all inventory items |
| 2 | For each item, compare quantity_in_stock with min_threshold |
| 3 | If quantity_in_stock < min_threshold, mark item as low stock |
| 4 | Generate alert list for Admin dashboard |

---

## UC-A7: Manage Promotions

| | |
|:--|:--|
| **ID** | UC-A7 |
| **Actor** | Admin |
| **Sprint** | 2 |
| **Preconditions** | Admin is authenticated |
| **Postconditions** | Promotion list is updated |

**Main Flow:**

| Step | Actor | Action |
|:----:|:-----:|:-------|
| 1 | Admin | Selects "Manage Promotions" from dashboard |
| 2 | System | Displays list of promotions with validity status |
| 3 | Admin | Chooses an action (Add / Edit / Delete) |
| 4 | System | Presents form with promotion fields |
| 5 | Admin | Fills in promotion details (code, discount_%/amount, valid_from, valid_until, usage_limit) |
| 6 | System | Validates the input (dates logical, discount positive) |
| 7 | System | Saves the promotion record |
| 8 | System | Confirms the operation and refreshes the list |

**Alternative Flows:**

| Alt | Condition | Flow |
|:----|:----------|:-----|
| 6a | Invalid Date Range | valid_from > valid_until → system rejects → Admin corrects |
| 6b | Duplicate Code | System rejects duplicate promotion code → Admin enters unique code |

---

# Employee Use Cases

---

## UC-E1: View Orders

| | |
|:--|:--|
| **ID** | UC-E1 |
| **Actor** | Employee |
| **Sprint** | 1 |
| **Preconditions** | Employee is authenticated |
| **Postconditions** | Employee has viewed current and/or past orders |

**Main Flow:**

| Step | Actor | Action |
|:----:|:-----:|:-------|
| 1 | Employee | Selects "Orders" from navigation |
| 2 | System | Displays list of orders sorted by creation time (newest first) |
| 3 | Employee | Reviews order details (items, customer, status, notes) |
| 4 | Employee | May filter by status (pending, preparing, ready, served) |

**Alternative Flows:**

| Alt | Condition | Flow |
|:----|:----------|:-----|
| 4a | Filter by Status | Employee clicks status filter → system shows matching orders only |
| 2a | No Orders | System displays empty state message |

---

## UC-E2: Update Order Status

| | |
|:--|:--|
| **ID** | UC-E2 |
| **Actor** | Employee |
| **Sprint** | 2 |
| **Preconditions** | Employee is authenticated; at least one order exists |
| **Postconditions** | Order status is updated to the next valid state |

**Main Flow:**

| Step | Actor | Action |
|:----:|:-----:|:-------|
| 1 | Employee | Views the order list (UC-E1) |
| 2 | Employee | Selects an order to update |
| 3 | System | Displays current status and available next statuses |
| 4 | Employee | Selects the new status (pending → preparing → ready → served → paid) |
| 5 | System | Validates the transition (must follow valid state machine) |
| 6 | System | Updates the order status |
| 7 | System | Confirms the update and refreshes the order view |

**Alternative Flows:**

| Alt | Condition | Flow |
|:----|:----------|:-----|
| 4a | Cancel Order | Employee selects "Cancelled" → system prompts reason → system marks order as cancelled |
| 5a | Invalid Transition | System rejects the status change → displays valid options → return to step 4 |

---

## UC-E3: Manage Menu Items

| | |
|:--|:--|
| **ID** | UC-E3 |
| **Actor** | Employee |
| **Sprint** | 1 |
| **Preconditions** | Employee is authenticated; at least one category exists |
| **Postconditions** | Menu item list is updated |

**Main Flow:**

| Step | Actor | Action |
|:----:|:-----:|:-------|
| 1 | Employee | Selects "Menu Items" from navigation |
| 2 | System | Displays list of menu items grouped by category |
| 3 | Employee | Chooses an action (Add / Edit / Delete / Update Availability) |
| 4 | System | Presents the appropriate form |
| 5 | Employee | Fills in item details (name, description, price, unit, category, status, image) |
| 6 | System | Validates the input |
| 7 | System | Saves the menu item record |
| 8 | System | Confirms the operation and refreshes the list |

**Alternative Flows:**

| Alt | Condition | Flow |
|:----|:----------|:-----|
| 3d | Update Availability | Employee toggles status (available ↔ unavailable ↔ out-of-stock) → go to step 7 |
| 6a | Validation Error | System displays error → Employee corrects → return to step 5 |

---

## UC-E4: View Personal Statistics

| | |
|:--|:--|
| **ID** | UC-E4 |
| **Actor** | Employee |
| **Sprint** | 1 |
| **Preconditions** | Employee is authenticated |
| **Postconditions** | Employee has viewed their personal performance metrics |

**Main Flow:**

| Step | Actor | Action |
|:----:|:-----:|:-------|
| 1 | Employee | Selects "My Statistics" from navigation |
| 2 | System | Displays personal metrics: orders handled, average processing time, tasks completed |
| 3 | Employee | Reviews the summary |

**Alternative Flows:**

| Alt | Condition | Flow |
|:----|:----------|:-----|
| 2a | No Data | System displays empty state with message "No statistics available yet" |

---

# Customer Use Cases

---

## UC-C1: Browse Menu

| | |
|:--|:--|
| **ID** | UC-C1 |
| **Actor** | Customer (Guest or Authenticated) |
| **Sprint** | 1 |
| **Preconditions** | System has at least one active menu with available items |
| **Postconditions** | Customer has viewed menu items and categories |
| **Extends** | `<<extend>>` UC-C1-EXT: Filter by Category |

**Main Flow:**

| Step | Actor | Action |
|:----:|:-----:|:-------|
| 1 | Customer | Opens the menu page (mobile or web) |
| 2 | System | Fetches active menus and their categories |
| 3 | System | Displays menu items with name, description, price, and image |
| 4 | Customer | Scrolls through available items |
| 5 | Customer | May optionally trigger **Filter by Category** (extension) |

**Alternative Flows:**

| Alt | Condition | Flow |
|:----|:----------|:-----|
| 2a | No Active Menu | System displays "Menu unavailable" message |
| 5a | Filter by Category | See UC-C1-EXT below |

### UC-C1-EXT: Filter by Category *(extension)*

| | |
|:--|:--|
| **ID** | UC-C1-EXT |
| **Extends** | UC-C1: Browse Menu |
| **Condition** | Customer selects a specific category pill/tab |

| Step | Action |
|:----:|:-------|
| 1 | Customer clicks a category filter pill |
| 2 | System filters displayed items to show only items in the selected category |
| 3 | Customer may select "All" to remove the filter |

---

## UC-C2: Place Order

| | |
|:--|:--|
| **ID** | UC-C2 |
| **Actor** | Customer (Authenticated) |
| **Sprint** | 1 (base + WhatsApp) → 2 (+ Apply Promotion) → 3 (+ Pay Online) |
| **Preconditions** | At least one menu item is available; customer is authenticated |
| **Postconditions** | Order is created with status "pending"; customer receives order confirmation |
| **Includes** | `<<include>>` UC-C2-INC1: Authenticate · `<<include>>` UC-C2-INC2: Calculate Total |
| **Extends** | `<<extend>>` UC-C2-EXT1: Order via WhatsApp · `<<extend>>` UC-C2-EXT2: Apply Promotion · `<<extend>>` UC-C2-EXT3: Pay Online |

**Main Flow:**

| Step | Actor | Action |
|:----:|:-----:|:-------|
| 1 | Customer | Adds items to cart (select item → set quantity → add) |
| 2 | Customer | Opens cart drawer |
| 3 | Customer | Reviews cart contents (items, quantities, prices) |
| 4 | System | Executes **Authenticate** (included sub-behavior) |
| 5 | System | Executes **Calculate Total** (included sub-behavior) |
| 6 | Customer | Selects ordering method (WhatsApp by default in Sprint 1) |
| 7 | Customer | Optionally triggers **Order via WhatsApp** or **Apply Promotion** (Sprint 2) |
| 8 | Customer | Adds order notes (optional) |
| 9 | Customer | Confirms the order |
| 10 | System | Creates the order with status "pending" |
| 11 | System | Displays order confirmation |

**Alternative Flows:**

| Alt | Condition | Flow |
|:----|:----------|:-----|
| 4a | Not Authenticated | System redirects to login/register → customer authenticates → return to step 5 |
| 6a | Order via WhatsApp | See UC-C2-EXT1 below |
| 7a | Apply Promotion | See UC-C2-EXT2 below |
| 9a | Cart Empty | System prevents submission → prompts customer to add items |
| 10a | Order Creation Failure | System displays error → customer retries |

### UC-C2-INC1: Authenticate *(included sub-behavior)*

| | |
|:--|:--|
| **ID** | UC-C2-INC1 |
| **Included By** | UC-C2: Place Order |
| **Description** | Customer must be authenticated before placing an order |

| Step | Action |
|:----:|:-------|
| 1 | System checks if customer is authenticated |
| 2 | If not authenticated, system redirects to login/register |
| 3 | Customer provides credentials (email/password) or registers |
| 4 | System validates credentials and creates session |
| 5 | Customer is now authenticated and can proceed with order |

### UC-C2-INC2: Calculate Total *(included sub-behavior)*

| | |
|:--|:--|
| **ID** | UC-C2-INC2 |
| **Included By** | UC-C2: Place Order |
| **Description** | Computes order subtotal, discount, and total |

| Step | Action |
|:----:|:-------|
| 1 | System sums (unit_price × quantity) for each cart item → subtotal |
| 2 | If promotion applied, system calculates discount_amount |
| 3 | System computes total_amount = subtotal − discount_amount |
| 4 | System displays the breakdown to customer |

### UC-C2-EXT1: Order via WhatsApp *(extension — Sprint 1)*

| | |
|:--|:--|
| **ID** | UC-C2-EXT1 |
| **Extends** | UC-C2: Place Order |
| **Condition** | Customer chooses WhatsApp as the ordering method (default in Sprint 1) |

| Step | Action |
|:----:|:-------|
| 1 | Customer clicks "Order via WhatsApp" button |
| 2 | System generates order summary message (items, quantities, total) |
| 3 | System opens WhatsApp with pre-filled message to restaurant's number |
| 4 | Customer sends the message |
| 5 | System creates the order record with status "pending" and payment_method = "whatsapp" |

| Alt | Condition | Flow |
|:----|:----------|:-----|
| 3a | WhatsApp Not Installed | System copies order summary to clipboard → customer pastes manually |

### UC-C2-EXT2: Apply Promotion *(extension — Sprint 2)*

| | |
|:--|:--|
| **ID** | UC-C2-EXT2 |
| **Extends** | UC-C2: Place Order |
| **Condition** | Customer enters a promotion code during checkout |

| Step | Action |
|:----:|:-------|
| 1 | Customer enters promotion code in cart |
| 2 | System validates the code (exists, within date range, usage limit not exceeded) |
| 3 | System applies discount (percentage or fixed amount) |
| 4 | System recalculates total via Calculate Total |
| 5 | System displays updated total with discount shown |

| Alt | Condition | Flow |
|:----|:----------|:-----|
| 2a | Invalid Code | System displays "Invalid or expired promotion" → customer may retry or skip |
| 2b | Expired Promotion | System displays "Promotion expired" → customer proceeds without discount |

### UC-C2-EXT3: Pay Online *(extension — Sprint 3 future)*

| | |
|:--|:--|
| **ID** | UC-C2-EXT3 |
| **Extends** | UC-C2: Place Order |
| **Condition** | Customer chooses online payment as the ordering method |
| **Sprint** | 3 (future, not in current scope) |

| Step | Action |
|:----:|:-------|
| 1 | Customer selects "Pay Online" as ordering method |
| 2 | System presents payment gateway |
| 3 | Customer enters payment details |
| 4 | System processes payment |
| 5 | System confirms payment and creates order with payment_method = "online" |

---

## UC-C3: Track Orders

| | |
|:--|:--|
| **ID** | UC-C3 |
| **Actor** | Customer (Authenticated) |
| **Sprint** | 2 |
| **Preconditions** | Customer is authenticated; customer has at least one order |
| **Postconditions** | Customer has viewed current order status |

**Main Flow:**

| Step | Actor | Action |
|:----:|:-----:|:-------|
| 1 | Customer | Selects "My Orders" from navigation |
| 2 | System | Displays list of customer's orders with current status |
| 3 | Customer | Selects an order to view details |
| 4 | System | Displays order details with status timeline (pending → preparing → ready → served) |

**Alternative Flows:**

| Alt | Condition | Flow |
|:----|:----------|:-----|
| 2a | No Orders | System displays empty state "No orders yet" |
| 3a | Order Cancelled | System shows cancellation notice |

---

## UC-C4: Manage Profile

| | |
|:--|:--|
| **ID** | UC-C4 |
| **Actor** | Customer (Authenticated) |
| **Sprint** | 2 |
| **Preconditions** | Customer is authenticated |
| **Postconditions** | Customer profile is updated |

**Main Flow:**

| Step | Actor | Action |
|:----:|:-----:|:-------|
| 1 | Customer | Selects "My Profile" from navigation |
| 2 | System | Displays current profile information (name, phone, email, address) |
| 3 | Customer | Edits desired fields |
| 4 | System | Validates the input |
| 5 | System | Saves the updated profile |
| 6 | System | Confirms the update |

**Alternative Flows:**

| Alt | Condition | Flow |
|:----|:----------|:-----|
| 4a | Validation Error | System displays error → Customer corrects → return to step 3 |

---

## UC-C5: View Order History

| | |
|:--|:--|
| **ID** | UC-C5 |
| **Actor** | Customer (Authenticated) |
| **Sprint** | 2 |
| **Preconditions** | Customer is authenticated |
| **Postconditions** | Customer has viewed past orders |

**Main Flow:**

| Step | Actor | Action |
|:----:|:-----:|:-------|
| 1 | Customer | Selects "Order History" from navigation |
| 2 | System | Displays list of past orders (completed/paid/cancelled) sorted by date |
| 3 | Customer | May select an order to view full details |
| 4 | System | Displays order details with items, prices, and final status |

**Alternative Flows:**

| Alt | Condition | Flow |
|:----|:----------|:-----|
| 2a | No Past Orders | System displays empty state |

---

## UC-C6: Contact Restaurant

| | |
|:--|:--|
| **ID** | UC-C6 |
| **Actor** | Customer (Guest or Authenticated) |
| **Sprint** | 1 |
| **Preconditions** | None |
| **Postconditions** | Customer has accessed restaurant contact information |

**Main Flow:**

| Step | Actor | Action |
|:----:|:-----:|:-------|
| 1 | Customer | Opens the contact page |
| 2 | System | Displays restaurant info cards (phone, address/map, WhatsApp) |
| 3 | Customer | May click phone number to call |
| 4 | Customer | May click map link to view location |
| 5 | Customer | May click WhatsApp link to send a message |

**Alternative Flows:** None (static information display)
