CREATE TABLE event_participants (
    event_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,

    status VARCHAR(20) NOT NULL DEFAULT 'registered',

    joined_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (event_id, user_id),

    FOREIGN KEY (event_id) REFERENCES events(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);