/* Create table */
CREATE TABLE USER
(
    id         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name       VARCHAR(35)  NOT NULL,
    email      VARCHAR(65)  NOT NULL,
    password   CHAR(64) NOT NULL,
    is_admin   BOOLEAN DEFAULT 0,
    created_at DATETIME     NOT NULL,

    PRIMARY KEY (id)
);

CREATE TABLE DESTINATION
(
    id          INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name        VARCHAR(35)  NOT NULL,
    image       VARCHAR(255) NOT NULL,
    description TEXT         NOT NULL,
    tags        TEXT         NOT NULL, -- voir JEAN
    created_at  DATETIME     NOT NULL,

    PRIMARY KEY (id)
);

CREATE TABLE TRAVEL
(
    id          INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name        VARCHAR(35)  NOT NULL,
    image       VARCHAR(255) NOT NULL,
    description TEXT         NOT NULL,
    tags        TEXT         NOT NULL, -- voir JEAN
    created_at  DATETIME     NOT NULL,
    destination_id INT UNSIGNED NOT NULL,

    FOREIGN KEY (destination_id) REFERENCES DESTINATION (id),
    PRIMARY KEY (id)
);

CREATE TABLE TAG
(
    id         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name       VARCHAR(35) NOT NULL,
    created_at DATETIME    NOT NULL,

    PRIMARY KEY (id)
);

-- pas besoin voir jean pour explication

-- CREATE TABLE DESTINATION_PIVO_TAGS(
-- 	destination_id INTEGER REFERENCES DESTINATION(id),
--     tag_id INTEGER REFERENCES TAG(id),
--     PRIMARY KEY(destination_id, tag_id)
-- );

-- CREATE TABLE TRAVEL_PIVO_TAGS
-- (
--     travel_id INT UNSIGNED NOT NULL,
--     tag_id    INT UNSIGNED NOT NULL,

--     PRIMARY KEY (travel_id, tag_id),
--     CONSTRAINT fk_travail
--         FOREIGN KEY (travel_id)
--             REFERENCES TRAVEL (id)
--             ON DELETE CASCADE
--             ON UPDATE RESTRICT,
--     CONSTRAINT fk_tag
--         FOREIGN KEY (tag_id)
--             REFERENCES TAG (id)
--             ON DELETE CASCADE
--             ON UPDATE RESTRICT
-- );

INSERT INTO user(name, email, password, is_admin, created_at) VALUES('admin','admin@admin.com','8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1, NOW());