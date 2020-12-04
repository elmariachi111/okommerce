# This file contains a user story for demonstration only.
# Learn how to get started with Behat and BDD on Behat's website:
# http://behat.org/en/latest/quick_start.html

Feature:
    In order to add products
    As an admin user
    I want to crud products

    Scenario: I can add and retrieve products
        When I add a new product titled "Banana" with:
            """
            sku=BA-1234
            description=A yellow banana, 7inch
            """
        Then there is a product with sku "BA-1234"
