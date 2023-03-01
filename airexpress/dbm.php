<?php

if (!class_exists('DatabaseManager')) {
  class DatabaseManager
  {
    private $db_conn;
    private $database = 'AirExpress_db'; // Will create a database for you in the myphpadmin mysql database
    private $host = "localhost:3307";  //change this to your host
    private $username = "root"; // username and password should be root and nothing by default,
    private $password = "";

    public function __construct()
    {
      $this->initDatabase();
      $this->connect();
    }

    public function connect()
    {
      $this->db_conn = new mysqli($this->host, $this->username, $this->password);
      if ($this->db_conn->connect_errno > 0) {
        die('Unable to connect to database [' . $this->db_conn->connect_error . ']');
      }
      mysqli_select_db($this->db_conn, $this->database);
    }

    public function query($sql) // call this function to perform sql queries
    {
      try {
        $this->db_conn->begin_transaction();
        $result = $this->db_conn->query($sql);
        $this->db_conn->commit();
        return $result;
      } catch (PDOException $e) {
        $this->db_conn->rollback();
        die($$this->db_conn->error);
      }
      
    }

    public function close()
    {
      $this->db_conn->close();
    }

    private function seeders($db) // inserts records into the initialized db
    {
      try {
        $db->begin_transaction();

        $db->query("INSERT INTO `Travel_Document` (`Travel_Document_Type`, `Travel_Document_ExpiryDate`, `Travel_Document_Number`, `Travel_Document_Country`) VALUES
          ('Passport', '2028-12-28', 'EGY248795581', 'Egypt'),
          ('Passport', '2030-02-24', 'OM1234578841', 'Oman'),
          ('Passport', '2025-07-11', 'QR8544799525', 'Qatar'),
          ('Passport', '2029-08-05', 'US1248728963', 'United States'),
          ('Passport', '2026-09-09', 'CN4785482657', 'Canada'),
          ('Passport', '2024-10-10', 'SA1212479347', 'Saudi Arabia'),
          ('Passport', '2027-11-09', 'CH4578494582', 'China'),
          ('Passport', '2026-04-05', 'MY7698494247', 'Malaysia'),
          ('Passport', '2029-03-01', 'AL4478985128', 'Algeria'),
          ('Passport', '2030-11-03', 'CH9376630123', 'China')"
        );

        $db->query("INSERT INTO `cities` (`City_Name`) VALUES ('Kuala Lumpur'), ('Canada'), ('Riyadh'), ('Dubai'), ('Tokyo'), ('New York City'), ('Paris'), ('Santa Cruz'), ('Cairo'), ('Jakarta'), ('Dammam');");

        $db->query("INSERT INTO `Airplane` (`Airplane_Type`, `Airplane_Seats`) VALUES
          ('Boeing 737','737'),
          ('Boeing 767', '736'),
          ('Airbus A320', '320'),
          ('Airbus A330', '330'),
          ('Boeing 777', '777'),
          ('Sukhoi Superjet SSJ00', '600'),
          ('Boeing 757', '757'),
          ('Boeing 717', '717'),
          ('Airbus A318', '318'),
          ('Airbus 340', '340')"
        );

        $db->query("INSERT INTO `Customer` (`Customer_Name`, `Customer_Phone_Number`,`Customer_Email`,`Customer_Password`, `Customer_Gender`, `Customer_DOB`, `Customer_Occupation`, `Customer_Nationality` , `Travel_Document_Number`) VALUES
          ('Mohammad Adel','+01111453219', 'adel@gmail.com', 'aokdao102A@', 'Male', '1990-09-01', 'Software engineer', 'Egypt', 'EGY248795581'),
          ('Abdul Kareem','+08321453219', 'kareem@gmail.com', 'gs0de9A@', 'Male', '1997-03-04', 'Teacher', 'Oman', 'OM1234578841'),
          ('Nasr abdullah','+05291453216', 'nasr21@gmail.com', 'ASO9**0dx', 'Male', '1994-04-11', 'Fitness coach', 'Qatar', 'QR8544799525'),
          ('Travis Scott','+02719833624', 'travisJack@gmail.com', 'Mo**3x0s', 'Male', '1997-08-27', 'Audio engineer', 'United States', 'US1248728963'),
          ('John Legend','+88297482625', 'John@gmail.com', 'asidj0&^1x', 'Male', '1995-12-12', 'Teacher', 'Canada', 'CN4785482657'),
          ('Maryam John','+0111793744', 'maryam1902@gmail.com', 'ASD##1easdx2', 'Female', '1999-06-20', 'Police officer', 'Saudi Arabia', 'SA1212479347'),
          ('Ng Zhi','+08290453219', 'ng@gmail.com', '39asjdi$%A', 'Male', '2000-10-03', 'Artist', 'China', 'CH4578494582'),
          ('Khadija Mohammad','+03631109123', 'kjas22@gmail.com', 'as120@0aksdoMAS', 'Female', '2001-11-18', 'Student', 'Malaysia', 'MY7698494247'),
          ('Amina Fadil','+38201109213', 'AMs90@gmail.com', 'AMsi@091', 'Female', '1989-10-07', 'Free lancer', 'Algeria', 'AL4478985128'),
          ('Sara Adel','+07168824012', 'SADOAS2@gmail.com', 'ASDOi@10as', 'Female', '1995-06-06', 'Software engineer', 'China', 'CH9376630123')"
        );

        $db->query("INSERT INTO `flight`( `Flight_From`, `Flight_To`, `Flight_Departure_Date`, `Flight_Departure_Time`, `Flight_Arrival_Date`, `Flight_Arrival_Time`, `Flight_Airplane`, `Flight_Duration`, `Flight_Price`, `Last_Seat`, `Flight_Status`) VALUES
          ('Cairo', 'Dubai', '2023-01-15', '15:30', '2023-01-16', '04:30', 'Boeing 737', '13', '4000', '22A', 'Arrived'),
          ('Oman', 'Dubai', '2023-03-18', '16:00', '2023-03-18', '23:00', 'Boeing 737', '7', '3290', '36F', 'Pending'),
          ('New York City', 'Qatar', '2023-02-25', '12:10', '2023-02-26', '18:00', 'Boeing 737', '5.83', '5340', '28G', 'Pending'),
          ('New York City', 'Kuala Lumpur', '2023-03-01', '01:00', '2023-08-04', '19:00', 'Airbus A318', '18', '3000', '27E', 'Arrived'),
          ('Paris', 'Canada', '2023-04-19', '02:00', '2023-04-19', '22:00', 'Airbus A318', '18', '10400', '40J', 'Pending'),
          ('Kuala Lumpur', 'Riyadh', '2023-01-01', '01:00', '2023-01-01', '12:00', 'Boeing 737', '12', '3840', '50G', 'Arrived'),
          ('Kuala Lumpur', 'Shanghai', '2023-01-10', '14:00', '2023-01-10', '19:30', 'Boeing 717', '5.5', '8090', '41D', 'Arrived'),
          ('Paris', 'Kuala Lumpur', '2023-02-22', '16:00', '2023-02-23', '18:30', 'Boeing 717', '14.5', '9590', '41D', 'Pending'),
          ('Canada', 'Kuala Lumpur', '2023-02-24', '08:30', '2023-02-25', '23:00', 'Airbus A318', '14.5', '6403', '61G', 'Pending'),
          ('Dubai', 'Cairo', '2023-01-10', '14:00', '2023-01-01', '12:00', 'Boeing 737', '5.5', '8090', '38F', 'Arrived')"
        );
        
        $db->query("INSERT INTO `ticket`(`Flight_Number`, `Ticket_Class`, `Ticket_Seat`, `Booking_Number`) VALUES
          ('1000','Economy','17A','1008'),
          ('1001','Economy','14A','1002'),
          ('1002','First Class','23B','1001'),
          ('1003','Economy','28G','1000'),
          ('1004','Business','31D','1005'),
          ('1005','Business','6A','1008'),
          ('1006','Economy','19A','1009'),
          ('1007','First Class','20D','1001'),
          ('1008','Economy','18C','1002'),
          ('1009','Business','18A','1003')"
        );
      
        $db->query("INSERT INTO `purchase`(`Customer_Email`, `Purchase_Amount`, `Purchase_Status`, `Purchase_Date`) VALUES  
          ('adel@gmail.com','99999','Accepted','2022-12-28'),
          ('kareem@gmail.com','99999','Pending','2023-01-01'),
          ('nasr21@gmail.com','99999','Pending','2023-01-10'),
          ('travisJack@gmail.com','99999','Accepted','2022-10-25'),
          ('John@gmail.com','99999','Accepted','2023-01-08'),
          ('maryam1902@gmail.com','99999','Pending','2023-01-15'),
          ('ng@gmail.com','99999','Accepted','2022-11-24'),
          ('kjas22@gmail.com','99999','Accepted','2022-12-15'),
          ('AMs90@gmail.com','99999','Pending','2022-12-03'),
          ('SADOAS2@gmail.com','99999','Rejected','2023-01-03')"
        );

        $db->query("INSERT INTO `booking`(`Flight_Number`, `Customer_Email`, `Booking_Status`) VALUES
          ('1001','adel@gmail.com','Pending'),
          ('1002','kareem@gmail.com','Pending'),
          ('1001','nasr21@gmail.com','Successful'),
          ('1003','travisJack@gmail.com','Successful'),
          ('1001','John@gmail.com','Cancelled'),
          ('1002','maryam1902@gmail.com','Successful'),
          ('1005','ng@gmail.com','Cancelled'),
          ('1004','kjas22@gmail.com','Pending'),
          ('1001','AMs90@gmail.com','Successful'),
          ('1002','SADOAS2@gmail.com','Successful')"
          );
    
        $db->query("INSERT INTO `administrator`(`Admin_Email`, `Admin_Password`, `Admin_Phone_Number`) VALUES 
          ('admin.airexpress@gmail.com','Admin@1234','03 1258 15548')"
        );

        $db->query("INSERT INTO `meal`(`Meal_Type`, `Meal_Price`) VALUES
          ('Standard','0.0'),
          ('Standard Combo','10.0'),
          ('Premium','20.0'),
          ('Premium Combo','30.0')"
        );

        $db->query("INSERT INTO `special_service`(`service_name`) VALUES
          ('Wheelchair'),
          ('Assistant')"
        );

        $db->commit();
        
      } catch (PDOException $e) {
        $db->rollback();
        die($e->getMessage());
      }
    }

    private function initDatabase()
    {
      $db = new mysqli($this->host, $this->username, $this->password);

      if ($db->query("SHOW DATABASES LIKE '{$this->database}';")->num_rows == 1)
        return;

      try {
        $db->begin_transaction();

        $db->query("CREATE DATABASE {$this->database};");

        mysqli_select_db($db, $this->database);

        $db->query("CREATE TABLE `Travel_Document` (
          `Travel_Document_Type` varchar(255) NOT NULL,
          `Travel_Document_ExpiryDate` date NOT NULL,
          `Travel_Document_Number` varchar(255) NOT NULL,
          `Travel_Document_Country` varchar(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
        );

        $db->query("CREATE TABLE `Passenger` (
          `Passenger_Number` int(4) NOT NULL,
          `Passenger_Name` varchar(255) NOT NULL,
          `Passenger_Travel_Document` varchar(255) NOT NULL,
          `Passenger_Email` varchar(255) NOT NULL,
          `Customer_Email` varchar(255),
          `Flight_Number` int(4),
          `Ticket_Number` int(4)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
        );

        $db->query("CREATE TABLE `Cities` (
          `City_Name` varchar(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
        );

        $db->query("CREATE TABLE `Airplane` (
          `Airplane_Type` varchar(255) NOT NULL,
          `Airplane_Seats` int(3) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
        );

        $db->query("CREATE TABLE `Customer` (
          `Customer_Name` varchar(255) NOT NULL,
          `Customer_Phone_Number` varchar(255) NOT NULL,
          `Customer_Email` varchar(255) NOT NULL,
          `Customer_Password` varchar(255) NOT NULL,
          `Customer_Gender` varchar(255) NOT NULL,
          `Customer_DOB` date NOT NULL,
          `Customer_Occupation` varchar(255) NOT NULL,
          `Customer_Nationality` varchar(255) NOT NULL,
          `Travel_Document_Number` varchar(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
        );

        $db->query("CREATE TABLE `Flight` (
          `Flight_Number` int(4) NOT NULL,
          `Flight_From` varchar(255) NOT NULL,
          `Flight_To` varchar(255) NOT NULL,
          `Flight_Departure_Date` date NOT NULL,
          `Flight_Departure_Time` time NOT NULL,
          `Flight_Arrival_Date` date NOT NULL,
          `Flight_Arrival_Time` time NOT NULL,
          `Flight_Airplane` varchar(255) NOT NULL,
          `Flight_Duration` decimal(10,2) NOT NULL,
          `Flight_Price` decimal(10,2) NOT NULL,
          `Last_Seat` varchar(255) NOT NULL,
          `Flight_Status` varchar(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
        );

        $db->query("CREATE TABLE `Ticket` (
          `Ticket_Number` int(4) NOT NULL,
          `Flight_Number` int(4),
          `Ticket_Class` varchar(255) NOT NULL,
          `Ticket_Seat` varchar(255) NOT NULL,
          `Booking_Number` int(4)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
        );

        $db->query("CREATE TABLE `Purchase` (
          `Purchase_Number` int(4) NOT NULL,
          `Customer_Email` varchar(255) NOT NULL,
          `Purchase_Amount` decimal(10,2) NOT NULL,
          `Purchase_Status` varchar(255) NOT NULL,
          `Purchase_Date` date NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
        );

        $db->query("CREATE TABLE `Booking` (
          `Booking_Number` int(4) NOT NULL,
          `Flight_Number` int(4),
          `Customer_Email` varchar(255) NOT NULL,
          `Booking_Status` varchar(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
        );

        $db->query("CREATE TABLE `Administrator` (
          `Admin_Email` varchar(255) NOT NULL,
          `Admin_Password` varchar(255) NOT NULL,
          `Admin_Phone_Number` varchar(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
        );

        $db->query("ALTER TABLE travel_document 
          ADD PRIMARY KEY (Travel_Document_Number)"
        );

        $db->query("ALTER TABLE Customer 
          ADD PRIMARY KEY (Customer_Email),
          ADD CONSTRAINT Travel_Document_Number_FK FOREIGN KEY (Travel_Document_Number) REFERENCES travel_document(Travel_Document_Number) ON UPDATE CASCADE"
        );

        $db->query("ALTER TABLE Flight 
          ADD PRIMARY KEY (Flight_Number),
          MODIFY Flight_Number int(4) AUTO_INCREMENT,
          AUTO_INCREMENT=1000"
        );

        $db->query("ALTER TABLE Purchase
          ADD PRIMARY KEY (Purchase_Number),
          ADD CONSTRAINT Customer_Email_FK FOREIGN KEY (Customer_Email) REFERENCES Customer(Customer_Email),
          MODIFY Purchase_Number int(4) AUTO_INCREMENT,
          AUTO_INCREMENT=1000"
        );

        $db->query("ALTER TABLE Booking 
          ADD PRIMARY KEY (Booking_Number),
          ADD CONSTRAINT Flight_Number_FK2 FOREIGN KEY (Flight_Number) REFERENCES Flight(Flight_Number) ON DELETE SET NULL,
          ADD CONSTRAINT Customer_Email_FK2 FOREIGN KEY (Customer_Email) REFERENCES Customer(Customer_Email),
          MODIFY Booking_Number int(4) AUTO_INCREMENT,
          AUTO_INCREMENT=1000"
        );

        $db->query("ALTER TABLE Ticket 
          ADD PRIMARY KEY (Ticket_Number),
          ADD CONSTRAINT Flight_Number_FK FOREIGN KEY (Flight_Number) REFERENCES Flight(Flight_Number) ON DELETE SET NULL,
          ADD CONSTRAINT Booking_Number_FK FOREIGN KEY (Booking_Number) REFERENCES Booking(Booking_Number) ON DELETE SET NULL,
          MODIFY Ticket_Number int(4) AUTO_INCREMENT,
          AUTO_INCREMENT=1000"
        );

        $db->query("ALTER TABLE Passenger 
          ADD PRIMARY KEY (Passenger_Number),
          ADD CONSTRAINT Ticket_Number_FK FOREIGN KEY (Ticket_Number) REFERENCES Ticket(Ticket_Number) ON DELETE SET NULL,
          ADD CONSTRAINT Customer_Email_FK4 FOREIGN KEY (Customer_Email) REFERENCES Customer(Customer_Email) ON DELETE SET NULL,
          ADD CONSTRAINT Flight_Number_FK5 FOREIGN KEY (Flight_Number) REFERENCES Flight(Flight_Number) ON DELETE SET NULL,
          MODIFY Passenger_Number int(4) AUTO_INCREMENT,
          AUTO_INCREMENT=1000"
        );

        $db->query("ALTER TABLE Administrator
          ADD PRIMARY KEY (Admin_Email)"
        );

        $db->query("ALTER TABLE Airplane
          ADD PRIMARY KEY (Airplane_Type)"
        );
        
        $this->seeders($db);

        $db->commit();
        $db->close();
      } catch (PDOException $e) {
        $db->rollback();
        die($e->getMessage());
      }
    }
  }
}

$db = new DatabaseManager();