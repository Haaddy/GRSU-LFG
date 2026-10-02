CREATE TABLE events (
    id SERIAL PRIMARY KEY,

    name VARCHAR(100) NOT NULL,
    description TEXT,

    start_at TIMESTAMP NOT NULL,
    end_at TIMESTAMP NOT NULL,

    location VARCHAR(255),

    need_team BOOLEAN NOT NULL DEFAULT FALSE,

    organizer_id INTEGER NOT NULL,

    max_participants INTEGER,

    max_teams INTEGER,
    min_team_members INTEGER,
    max_team_members INTEGER,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (organizer_id) REFERENCES users(id)
);