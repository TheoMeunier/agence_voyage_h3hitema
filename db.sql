/* Create table */
CREATE TABLE USER
(
    id         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name       VARCHAR(35)  NOT NULL,
    email      VARCHAR(65)  NOT NULL,
    password   VARCHAR(125) NOT NULL,
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
    created_at  DATETIME     NOT NULL,

    PRIMARY KEY (id)
);

CREATE TABLE TRAVEL
(
    id          INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name        VARCHAR(35)  NOT NULL,
    image       VARCHAR(255) NOT NULL,
    description TEXT         NOT NULL,
    created_at  DATETIME     NOT NULL,

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

CREATE TABLE TRAVEL_PIVO_TAGS
(
    travel_id INT UNSIGNED NOT NULL,
    tag_id    INT UNSIGNED NOT NULL,

    PRIMARY KEY (travel_id, tag_id),
    CONSTRAINT fk_travail
        FOREIGN KEY (travel_id)
            REFERENCES TRAVEL (id)
            ON DELETE CASCADE
            ON UPDATE RESTRICT,
    CONSTRAINT fk_tag
        FOREIGN KEY (tag_id)
            REFERENCES TAG (id)
            ON DELETE CASCADE
            ON UPDATE RESTRICT
);