import mysql.connector

class adminHelper:
	# these are the commands ive written thus far, hopefully all that will
	# need to happen to create more functionality is to add new mySQL commands
	# below
	CREATE_USER = [f"CREATE USER {primary}@localhost IDENTIFIED BY '{secondary}';",
	f"GRANT INSERT, DELETE, UPDATE ON qna. * TO '{primary}'@'localhost';", "FLUSH PRIVILEGES;"]

	DELETE_USER = f"DROP USER {primary}@localhost"

	INSERT_ENTRY = [f"INSERT INTO question_concept (question) VALUES ({primary});",
	f"INSERT INTO question_concept (answer) VALUES ({primary});"]

	DELETE_ENTRY = [f"DELETE FROM question WHERE {primary};", f"DELETE FROM answer WHERE {primary};"]

	def runCommand(self, command, args):
                primary = args
                if type(args) is list:
                        primary = args[0]
                        secondary = args[1]
                        
		try:
			#eventually i will change this to require a password be input 
                        connection = mysql.connector.connect(host='localhost', database='qna', user='admin',password="password")
                        if connection.is_connected():
                                cursor = connection.cursor()
                        for command in mysqlCommands:
                                cursor.execute(command)
                        
                        #after all commands have been execute we have to commit it all to
                        # the database
                        cursor.commit()

		except Error as e:
	    	print("Error while connecting to MySQL", e)
		finally:
		    if connection.is_connected():
		        cursor.close()
		        connection.close()
		        print("MySQL connection is closed")
