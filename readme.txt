MongoInsert is a php script to insert hotel offerings and business reviews into a MongoDB database.
	It reads a provided text file named 'offerings.txt' that contains entries in json format, and then adds 
	each entry into a MongoDB database. It then reads in line by line a second file named "reviews.txt", and 
	adds each entry into the same database.
	
HotelSearch is a web based app using php and jQuery that provides a front end to search the hotel offerings 
	inserted into the MongoDB database populated by MongoInsert and returns the results in a list format.