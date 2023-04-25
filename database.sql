CREATE DATABASE IF NOT EXISTS videoslaravel;
USE videoslaravel;

DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users(
    id int auto_increment not null,
    role varchar(20),
    name varchar(255),
    surname varchar(255),
    email varchar(255),
    password varchar(255),
    image varchar(255),
    created_at datetime,
    updated_at datetime,
    remember_token varchar(255),

    CONSTRAINT pk_users primary key (id)
)ENGINE=InnoDb;

DROP TABLE IF EXISTS videos;
CREATE TABLE IF NOT EXISTS videos(
    id int auto_increment not null,
    user_id int not null,
    title varchar(255),
    description text,
    status varchar(20),
    image varchar(255),
    video_path varchar(255),
    created_at datetime,
    updated_at datetime,

    CONSTRAINT pk_videos primary key (id),
    CONSTRAINT fk_videos_users FOREIGN KEY (user_id) REFERENCES users(id)

    )ENGINE=InnoDb;

DROP TABLE IF EXISTS comments;
CREATE TABLE IF NOT EXISTS comments(
    id int auto_increment not null,
    user_id int not null,
    video_id int not null,
    body text,
    created_at datetime,
    updated_at datetime,

    CONSTRAINT pk_commet primary key (id),
    CONSTRAINT fk_videos_commets FOREIGN KEY (video_id) REFERENCES videos(id),
    CONSTRAINT fk_users_commets FOREIGN KEY (user_id) REFERENCES users(id)

    )ENGINE=InnoDb;
