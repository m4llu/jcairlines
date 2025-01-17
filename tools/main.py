# This script is for adding example flights to the database
import mysql.connector
import random
import schedule
import time
from datetime import datetime, timedelta

# Database connection setup
def connect_to_db():
    return mysql.connector.connect(
        host="localhost",  # e.g. "localhost"
        user="root",  # e.g. "root"
        password="",
        database="db",
        port="3307"
    )

# List of cities for flight generation
cities = ['Helsinki', 'Oulu', 'Rovaniemi', 'Stockholm', 'Oslo', 'Kööpenhamina', 'Bergen', 'Reykjavik', 'Keflavik', 'Malmö', 'Trondheim']

# Generate all city pairs (excluding same-city flights)
def generate_city_pairs():
    city_pairs = []
    for departure_city in cities:
        for arrival_city in cities:
            if departure_city != arrival_city:
                city_pairs.append((departure_city, arrival_city))
    return city_pairs

# Generate dates between two given dates
def generate_dates(start_date, end_date):
    current_date = start_date
    while current_date <= end_date:
        yield current_date.strftime('%Y-%m-%d')
        current_date += timedelta(days=1)

# Function to generate random departure time (Lähtöaika) based on Aikaväli
def generate_departure_time(aikavali):
    if aikavali == 'Aamu':  # Morning (06:00 to 12:00)
        hour = random.randint(6, 11)
        minute = random.randint(0, 59)
    elif aikavali == 'Päivä':  # Day (12:00 to 18:00)
        hour = random.randint(12, 17)
        minute = random.randint(0, 59)
    elif aikavali == 'Ilta':  # Evening (18:00 to 23:59)
        hour = random.randint(18, 23)
        minute = random.randint(0, 59)
    else:
        hour = minute = 0  # Default in case of an invalid Aikaväli
    return f"{hour:02}:{minute:02}:00"  # Return time in HH:MM:SS format

# Function to generate random flight data
def generate_flight_data(departure_city, arrival_city, flight_date):
    flight_time = random.choice(['Aamu', 'Päivä', 'Ilta'])  # Randomly select time of day
    departure_time = generate_departure_time(flight_time)  # Generate departure time based on Aikaväli
    aircraft = random.choice(['A220-100', 'A220-300', 'Q400'])
    ticket_price = round(random.uniform(150.00, 500.00), 2)
    available_seats = random.randint(5, 50)

    # Return data as tuple (for SQL insertion)
    return (departure_city, arrival_city, flight_date, flight_time, aircraft, ticket_price, available_seats, departure_time)

# Function to insert flight into the database
def insert_flight(departure_city, arrival_city, flight_date):
    # Generate flight data
    flight_data = generate_flight_data(departure_city, arrival_city, flight_date)

    # Connect to the database
    db = connect_to_db()
    cursor = db.cursor()

    # Insert query (including Lähtöaika)
    insert_query = """
    INSERT INTO lennot (LähtöKaupunki, KohdeKaupunki, LentoPäivämäärä, Aikaväli, Kone, LipunHinta, VapaatPaikat, Lähtöaika) 
    VALUES (%s, %s, %s, %s, %s, %s, %s, %s)
    """
    
    # Execute query and commit
    cursor.execute(insert_query, flight_data)
    db.commit()

    # Print the added flight
    print(f"Added flight: {flight_data[0]} -> {flight_data[1]} on {flight_data[2]} at {flight_data[3]} with departure time {flight_data[7]} and {flight_data[5]}€ price and {flight_data[6]} available seats.")

    # Close the connection
    cursor.close()
    db.close()
    time.sleep(0.05)

# Function to add all flights between two dates
def add_flights_between_dates(start_date, end_date):
    # Generate all city pairs
    city_pairs = generate_city_pairs()
    
    # Generate all dates between the start and end date
    for flight_date in generate_dates(start_date, end_date):
        for departure_city, arrival_city in city_pairs:
            insert_flight(departure_city, arrival_city, flight_date)

# Run mass add of flights for a given date range
def mass_add_flights():
    # Set your start and end dates for flight generation
    start_date = datetime(2024, 10, 30)  # Example start date
    end_date = datetime(2024, 12, 30)  # Example end date

    # Add flights between the two dates
    add_flights_between_dates(start_date, end_date)

# Run the script once
if __name__ == "__main__":
    mass_add_flights()
