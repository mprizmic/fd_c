select car.id, car.nombre, ea.descripcion
, car.oferta_educativa_id
, ea.id
from Fd.carrera as car 
left join Fd.estado_carrera ea on ea.id=car.estado_id
where  ea.descripcion="Residual"

