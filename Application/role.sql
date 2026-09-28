create table role{
    numRole int NOT NULL AUTO_INCREMENT,
    libelleRole varchar NOT NULL
};

ALTER TABLE employe ADD role 
FOREIGN KEY (role) REFERENCES role(role);

