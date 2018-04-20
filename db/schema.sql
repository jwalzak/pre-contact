CREATE TABLE user_contact(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fname CHAR(50) NOT NULL,
    lname CHAR(50) NOT NULL,
    email CHAR(50) NOT NULL,
    phone CHAR(15) NOT NULL, -- pattern 1(000)-123-1234
	birthday DATE NOT NULL,
    relationship CHAR(50) NOT NULL,
    homepage CHAR(100) NOT NULL,
    step_rel bool,
    background_col CHAR(7) -- It will be passed as a string so I might as well keep it that way
);
