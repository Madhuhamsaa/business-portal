import mysql.connector

# Connect to MySQL
conn = mysql.connector.connect(
    host="localhost", user="root", password="", database="business_portal_db"
)

cursor = conn.cursor()

# Dashboard statistics
queries = {
    "Customers": "SELECT COUNT(*) FROM customers",
    "Products": "SELECT COUNT(*) FROM products",
    "Sales Orders": "SELECT COUNT(*) FROM sales_orders",
    "Pending Orders": "SELECT COUNT(*) FROM sales_orders WHERE status='Pending'",
    "Completed Orders": "SELECT COUNT(*) FROM sales_orders WHERE status='Completed'",
    "Inventory Value": "SELECT SUM(price * stock) FROM products",
}

print("=" * 45)
print("        BUSINESS PORTAL REPORT")
print("=" * 45)

for title, query in queries.items():
    cursor.execute(query)
    result = cursor.fetchone()[0]

    if result is None:
        result = 0

    if title == "Inventory Value":
        print(f"{title:<20}: €{result:,.2f}")
    else:
        print(f"{title:<20}: {result}")

print("=" * 45)

cursor.close()
conn.close()
