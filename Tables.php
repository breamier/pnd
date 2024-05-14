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
        Location VARCHAR(80),
        PRIMARY KEY (AffiliationID)
    )";

    $conn->query($sql);

    $sql = "CREATE TABLE AssocInterest(
        AssocIntID INT PRIMARY KEY 
    )";

    $conn->query($sql);
    $sql = "CREATE TABLE Interest(
        InterestID INT PRIMARY KEY,
        Name VARCHAR(40)
    )";

    $conn->query($sql);

        $sql = "CREATE TABLE ContactInformation(
            Type VARCHAR(40) NOT NULL,
            Description VARCHAR(40) NOT NULL,
            IndividualID INT,
            AffiliationID INT,
            FOREIGN KEY (IndividualID) REFERENCES Individual(IndividualID),
            FOREIGN KEY (AffiliationID) REFERENCES Affiliation(AffiliationID), 
            PRIMARY KEY (Type,Description)

        )";

    $conn->query($sql);
    // Relational Tables
    $sql = "CREATE TABLE Individual_AssocInterest(
        AssocIntID INT NOT NULL,
        IndividualID INT NOT NULL,
        FOREIGN KEY (AssocIntID) REFERENCES AssocInterest(AssocIntID),
        FOREIGN KEY (IndividualID) REFERENCES Individual(IndividualID)

    )";

    $conn->query($sql);
    $sql = "CREATE TABLE Interest_AssocInterest(
        InterestID INT NOT NULL,
        AssocIntID INT NOT NULL,
        FOREIGN KEY (InterestID) REFERENCES Interest(InterestID),
        FOREIGN KEY (AssocIntID) REFERENCES AssocInterest(AssocIntID)

    )";

    $conn->query($sql);
    $sql = "CREATE TABLE Establishes(
        IndividualID INT NOT NULL,
        ConnectionID INT NOT NULL,
        FOREIGN KEY (IndividualID) REFERENCES Individual(IndividualID),
        FOREIGN KEY (ConnectionID) REFERENCES Connection(ConnectionID)
    )";
    $conn->query($sql);
    $sql = "CREATE TABLE PartOf(
        AffiliationID INT NOT NULL,
        ConnectionID INT NOT NULL,
        FOREIGN KEY (AffiliationID) REFERENCES Affiliation(AffiliationID),
        FOREIGN KEY (ConnectionID) REFERENCES Connection(ConnectionID)
    )";
    $conn->query($sql);
    $sql = "CREATE TABLE Affiliation_ContactInfo(
        AffiliationID INT NOT NULL,
        Type VARCHAR(40) NOT NULL,
        Description VARCHAR(40) NOT NULL,
        FOREIGN KEY (AffiliationID) REFERENCES Affiliation(AffiliationID),
        FOREIGN KEY (Type, Description) REFERENCES ContactInformation(Type, Description)
    )";
    
    $conn->query($sql);
    $sql = "CREATE TABLE Individual_ContactInfo(
        IndividualID INT NOT NULL,
        Type VARCHAR(40) NOT NULL,
        Description VARCHAR(40) NOT NULL,
        FOREIGN KEY (IndividualID) REFERENCES Individual(IndividualID),
        FOREIGN KEY (Type, Description) REFERENCES ContactInformation(Type, Description)
    )";
    
    $conn->query($sql);







    $conn->close();