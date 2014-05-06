select e.apodo, n.abreviatura, uo.id as uo_id, oe.id as oe_id, car.nombre
from establecimiento as e 
inner join unidad_educativa as ue on e.id = ue.establecimiento_id
inner join nivel n on ue.nivel_id = n.id
inner join unidad_oferta uo on uo.unidad_educativa_id = ue.id
inner join oferta_educativa as oe on oe.id = uo.oferta_educativa_id
inner join carrera as car on oe.id = car.oferta_educativa_id
where e.apodo="ENS 6"
and n.abreviatura="Ter"
and oe.nivel_id = n.id
