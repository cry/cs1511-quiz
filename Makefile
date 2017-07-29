db:
	rm quiz.db && touch quiz.db && sqlite3 quiz.db < schema.sql
