# Online food order
This project contains both the admin side function and customer function. 
This was achieved by connecting with mysql database.

There are four tables in the database:
1. Admin Table - stores the admin details
2. Category Table - stores the food categories and its details
3. Food Table - stores food items with its category id
4. Order table - stores the details of the customer orders 

Admin Page
1. Manage-Admin
   This page displays the details of admins by fetching it from the admin table. In this page we can add, update and delete admins.
2. Manage-Category
   This page displays the details of categories by fetching it from the category table. In this page we can add, update and delete food categories.
3. Manage-Food
   This page displays the details of food by fetching it from the food table. In this page we can add, update and delete food
4. Manage-Order
   This page displays the details of orders given by the customer which is fetched from the order table in the database. Here we can only update the orders.
   
Customer Page
1. Index
   Displays some of the food categories and food items from which you can also navigate to categories and order page.
2. Categories
   This page displays the categories which are active and if we select a  particular category it displays the food under that category.
3. Food
   This page displays the food items that are active and it also has a search which displays the food items with simiar food titlt or description
4. order
   The customers can place their orders from this page. Their orders are reflected in the order table of the databse.
  
PHP Functions
1. CONSTANTS
2. _SESSION[]
3. _GET[]
4. _POST[]
5. msqli_fetch_assoc()
6. mysqli_query()
7. mysqli_num_rows()
8. isset()
9. include()
