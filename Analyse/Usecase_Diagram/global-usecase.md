@startuml
left to right direction
skinparam packageStyle rectangle
skinparam shadowing false

actor "Admin (Restaurant Owner)" as Admin
actor "Staff / Employees" as Staff
actor "Customer" as Customer

rectangle "Mini Restaurant Management System" {
  
  package "Administration & Management" {
    Admin -- (Manage Menu)
    Admin -- (Staff Management)
    Admin -- (Monitor Orders)
    Admin -- (Financial Reports & Stats)
    Admin -- (Notifications)
  }
  
  package "Operational Management" {
    Staff -- (Take Orders)
    Staff -- (Update Order Status)
    Staff -- (Receive Alerts)
    Staff -- (Use Mobile-Friendly UI)
    (Take Orders) .. (Authentication & Roles) : <<include>>
    (Update Order Status) .. (Authentication & Roles) : <<include>>
  }

  package "Customer Interaction" {
    Customer -- (Browse Menu)
    Customer -- (Place Online Order)
    Customer -- (Place In-Restaurant Order)
    Customer -- (Order Confirmation)
    (Place Online Order) .. (Authentication & Roles) : <<include>>
    (Place In-Restaurant Order) .. (Authentication & Roles) : <<include>>
  }

}
@enduml