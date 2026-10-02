CREATE TABLE teams (
    id SERIAL PRIMARY KEY,

    event_id INTEGER NOT NULL,
    name VARCHAR(100) NOT NULL,
    captain_id INTEGER NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (event_id) REFERENCES events(id),
    FOREIGN KEY (captain_id) REFERENCES users(id)
);