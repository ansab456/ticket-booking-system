import sqlite3
import cgi

# establish connection to the database
conn = sqlite3.connect('journeys.db')
c = conn.cursor()

# get user input from form submission
form = cgi.FieldStorage()
departure = form.getvalue('departure')
destination = form.getvalue('destination')
day = form.getvalue('day')

# retrieve bus journey information from the database
c.execute("SELECT * FROM bus_journeys WHERE departure=? AND destination=? AND day_of_week=?", (departure, destination, day))
journeys = c.fetchall()

# print the available bus journeys to the user
print("<h3>Available Bus Journeys:</h3>")
if journeys:
    print("<ul>")
    for journey in journeys:
        print("<li>Price: £{} | Journey Time: {} hours</li>".format(journey[3], journey[4]))
    print("</ul>")
else:
    print("<p>Sorry, no bus journeys available for the selected route on the selected day.</p>")

# close the database connection
conn.close()
# establish connection to the database
conn = sqlite3.connect('journeys.db')
c = conn.cursor()

# get user input from form submission
form = cgi.FieldStorage()
departure = form.getvalue('departure')
destination = form.getvalue('destination')
day = form.getvalue('day')
price = form.getvalue('price')
journey_time = form.getvalue('journey_time')
reference_number = generate_reference_number() # function to generate a unique reference number for the ticket

# insert ticket information into the database
c.execute("INSERT INTO tickets (departure, destination, day_of_week, price, journey_time, reference_number) VALUES (?, ?, ?, ?, ?, ?)", (departure, destination, day, price, journey_time, reference_number))
conn.commit()

# print confirmation message to the user
print("<p>Ticket booked successfully! Reference number: {}</p>".format(reference_number))

# close the database connection
conn.close()
