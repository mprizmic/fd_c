SELECT e.apodo, n.abreviatura, car.nombre, tf.codigo
from Fd.establecimiento as e 
inner join Fd.unidad_educativa as ue on e.id = ue.establecimiento_id
inner join Fd.unidad_oferta as uo on uo.unidad_educativa_id = ue.id
inner join Fd.oferta_educativa as oe on oe.id = uo.oferta_educativa_id
inner join Fd.nivel as n on oe.nivel_id = n.id
inner join Fd.carrera as car on car.oferta_educativa_id = oe.id
inner join Fd.tipo_formacion as tf on car.formacion_id = tf.id
where e.apodo="ENS 6"
