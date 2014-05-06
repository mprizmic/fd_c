select e.apodo, e.id as e_id, ue.id as unidad_educativa, n.nombre, car.nombre, uo.id as unidad_oferta, ix.id as ix_id
from Fd.establecimiento e 
inner join Fd.unidad_educativa ue on ue.establecimiento_id= e.id
inner join Fd.nivel n on ue.nivel_id=n.id
inner join Fd.unidad_oferta uo on ue.id=uo.unidad_educativa_id
inner join Fd.oferta_educativa oe on oe.id= uo.oferta_educativa_id
left join Fd.inicial_x ix on ix.unidad_oferta_id=uo.id
left join Fd.carrera as car on car.oferta_educativa_id= oe.id
order by n.id