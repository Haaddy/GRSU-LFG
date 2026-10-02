CREATE TABLE team_join_requests (
    id SERIAL PRIMARY KEY,

    team_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,

    status VARCHAR(20) NOT NULL DEFAULT 'pending',

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (team_id) REFERENCES teams(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);







