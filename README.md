# delivertime
The request can be sent to [hosted-URL]/delivery-time  
Params would be POSTed as eg:  
day=3&location=1&supplier=1&time=18:00  

Basic errors are returned for invalid params or missing values, DB query exception, and invalid values (such as a supplier does not have a specific day or location).

Returns json response, for example:  
{"Delivery Date":"06-06-2019"}  
OR  
{"Error":"Missing parameters or data"}
