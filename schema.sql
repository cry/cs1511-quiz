CREATE TABLE results(
    qid             TEXT        NOT NULL,
    zid             CHAR(8)     NOT NULL,
    choices         BLOB        NOT NULL
);

CREATE TABLE quizes(
    qid             INTEGER     PRIMARY KEY NOT NULL,
    canonical       TEXT        NOT NULL UNIQUE,
    name            TEXT        NOT NULL,
    questions       BLOB        NOT NULL,
    background      TEXT
);

CREATE TABLE users(
    id              INTEGER     PRIMARY KEY NOT NULL,
    username        TEXT        NOT NULL UNIQUE,
    password        TEXT        NOT NULL
);

INSERT INTO users (username, password) VALUES ("lol", "064b1b60fa96dc5a7a49f461f1ceb7a0db34d38405f4fb9dea9241ad408a00f6");

INSERT INTO quizes (canonical, name, background, questions) VALUES ("test", "mark is a meme", "#262626", '[ { "question": "What is the value of f(4)?", "code": "aW50IGYoaW50IG4pCnsKICAgaWYgKG4gPT0gMCkKICAgICAgcmV0dXJuIDA7CiAgIGVsc2UKICAgICAgcmV0dXJuIG4gKyBmKG4tMSk7Cn0=", "choices": [ "0", "None of the rest", "10", "24" ], "correct": 2 }, { "question": "What is the final value of a?", "code": "aW50IGEgPSA1OyAgCmludCAqcDsKcCA9ICZhOwoqcCA9ICpwICsgMTsKYSsrOw==", "choices": [ "5", "6", "7", "None of the rest" ], "correct": 1 } ]');
INSERT INTO quizes (canonical, name, questions) VALUES ("test2", "mark is a giant meme", "{}");
