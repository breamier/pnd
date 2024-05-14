<?php
    include 'Connect.php';

    
    $sql  = "CREATE TABLE Individual(
        Name VARCHAR (40),
        Birth DATE,
        IndividualID INT,
        Gender CHAR(40),
        PRIMARY KEY (IndividualID)
    )";


    $conn->query($sql);

    $sql = "CREATE TABLE Connection(
        ConnectionID INT,
        Role VARCHAR(40),
        PRIMARY KEY (ConnectionID)
    )";

    $conn->query($sql);
    $sql = "CREATE TABLE Affiliation(
        AffiliationID INT,
        Name VARCHAR(40),
        Type VARCHAR(20),
        Location VARCHAR(80)
        PRIMARY KEY (AffiliatioID)
    )";

    $conn->query($sql);
    $sql = "CREATE TABLE AssocInterest(
        AssocIntID INT PRIMARY KEY,

    )";

    $conn->query($sql);
    $sql = "CREATE TABLE Interests(
        InterestID INT PRIMARY KEY,
        Name VARCHAR(40),
    )";

    $conn->query($sql);

    // Relational Tables
    $sql = "CREATE TABLE Individual_AssocInterest(
        AssocIntID INT NOT NULL,
        IndividualID INT NOT NULL,
        FOREIGN KEY (AssocIntID) REFERENCES AssocInterests(AssocIntID),
        FOREIGN KEY (IndividualID) REFERENCES Individual(IndividualID)

    )";

    $conn->query($sql);
    $sql = "CREATE TABLE Interest_AssocInterest(
        InterestID INT NOT NULL,
        IndividualID INT NOT NULL,
        FOREIGN KEY (InterestID) REFERENCES Interests(InterestID),
        FOREIGN KEY (IndividualID) REFERENCES Individual(IndividualID)

    )";







    $conn->close();