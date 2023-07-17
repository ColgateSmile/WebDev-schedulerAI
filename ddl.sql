CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (email)
);

CREATE TABLE lists (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL, 
    created_at DATETIME NOT NULL,
    created_by INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (created_by) REFERENCES users(id)
);

CREATE TABLE participants (
    list_id INT NOT NULL,
    user_id INT NOT NULL,
    PRIMARY KEY (list_id, user_id)
);

CREATE TABLE tasks (
    id INT NOT NULL AUTO_INCREMENT,
    list_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    due_date DATETIME NOT NULL,
    completed BOOLEAN NOT NULL,
    user_in_charge INT NOT NULL,
    PRIMARY KEY (list_id, id),
    FOREIGN KEY (user_in_charge) REFERENCES users(id),
    FOREIGN KEY (list_id) REFERENCES lists(id)
);