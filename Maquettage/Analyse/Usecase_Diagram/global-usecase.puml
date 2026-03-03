@startuml
top to bottom direction
skinparam packageStyle rectangle

actor Admin
actor Employer
actor Customer

rectangle "Mini Restaurant Management System" {

    (Authentication)

    Admin -- (Manage Users)
    Admin -- (Manage Menu)
    Admin -- (View Reports & Statistics)
    Admin -- (Manage Inventory)
    Admin -- (Authentication)

    Employer -- (View Orders)
    Employer -- (View Personal Reports)
    Employer -- (Manage Menu Items)
    Employer -- (Authentication)

    Customer -- (Browse Menu)
    Customer -- (Place Order)
    Customer -- (Manage Profile)
    Customer -- (Authentication)

    ' include relationships (lines only, no arrows)
    (Manage Users) .. (Authentication) : <<include>>
    (Manage Menu) .. (Authentication) : <<include>>
    (View Reports & Statistics) .. (Authentication) : <<include>>
    (Manage Inventory) .. (Authentication) : <<include>>

    (View Orders) .. (Authentication) : <<include>>
    (View Personal Reports) .. (Authentication) : <<include>>
    (Manage Menu Items) .. (Authentication) : <<include>>

    (Browse Menu) .. (Authentication) : <<include>>
    (Place Order) .. (Authentication) : <<include>>
    (Manage Profile) .. (Authentication) : <<include>>
}
@enduml