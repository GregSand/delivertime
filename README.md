# delivertime
The request can be sent to [hosted-URL]/delivery-time  
Params would be POSTed as eg:  
day=3&location=1&supplier=1&time=18:00  

Basic errors are returned for invalid params or missing values, DB query exception, and invalid values (such as a supplier does not have a specific day or location).
