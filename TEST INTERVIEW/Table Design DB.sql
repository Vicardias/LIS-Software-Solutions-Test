
create database Travels


create table Travels (

	ID_Travel Int Identity(1,1) Not Null,
	Travel_Start Varchar(500) Not Null,
	Travel_Destination Varchar(500) Not Null,
	Start_Date Date Not Null,
	Expiration_Date Date Not Null,
	Passenger_Name Varchar(500) Not Null

)

create table Passenger (

	ID_Passenger Int Identity(1,1) Not Null,
	Passenger_Name Varchar(500) Not Null,
	Age Int Not Null,
	Phone Varchar(50) Not Null,
	Email Varchar(100) Not Null

)

create table Company (

	ID_Company Int Identity(1,1) Not Null,
	Name Varchar(100) Not Null,
	Address Varchar(100) Not Null,
	Phone Varchar(100) Not Null

)

create table Airplane_Ticket (

	ID_Airplane_Ticket Int Identity(1,1) Not Null,
	ID_Passenger Int Not Null,
	ID_Company Int Not Null,
	ID_Travel Int Not Null,
	Class Varchar(50) Not Null,
	Seat Varchar(50) Not Null

)