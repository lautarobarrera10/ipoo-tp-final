CREATE DATABASE bdviajes;

CREATE TABLE empresa(
    idempresa bigint AUTO_INCREMENT,
    enombre varchar(150),
    edireccion varchar(150),
    PRIMARY KEY (idempresa)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- Tabla Persona
CREATE TABLE persona(
    documento varchar(15),
    nombre varchar(30),
    apellido varchar (30),
    PRIMARY KEY (documento)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE responsable (
    rnumeroempleado bigint AUTO_INCREMENT,
    rnumerolicencia bigint,
    rdocumento varchar(15),
    PRIMARY KEY (rnumeroempleado),
    FOREIGN KEY (rdocumento) REFERENCES persona (documento)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
    )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;;
	
CREATE TABLE viaje (
    idviaje bigint AUTO_INCREMENT, /*codigo de viaje*/
	vdestino varchar(150),
    vcantmaxpasajeros int,
	idempresa bigint,
    rnumeroempleado bigint,
    vimporte float,
    PRIMARY KEY (idviaje),
    FOREIGN KEY (idempresa) REFERENCES empresa (idempresa),
	FOREIGN KEY (rnumeroempleado) REFERENCES responsable (rnumeroempleado)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT = 1;
	
CREATE TABLE pasajero (
    pdocumento varchar(15),
	ptelefono int, 
	idviaje bigint,
    PRIMARY KEY (pdocumento),
	FOREIGN KEY (idviaje) REFERENCES viaje (idviaje)	
    ON UPDATE CASCADE 
    ON DELETE CASCADE,
    FOREIGN KEY (pdocumento) REFERENCES persona (documento)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
    )ENGINE=InnoDB DEFAULT CHARSET=utf8; 
 



