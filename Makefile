db:
	rm quiz.db && touch quiz.db && sqlite3 quiz.db < schema.sql
iridium_fixperms:
	chown -R nginx:nginx * && chmod -R 755 *
