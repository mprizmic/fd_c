--- oferta de una unidad educativa sin localizacion
select e.apodo, e.id as e_id, 
ue.id as unidad_educativa
,uo.id as uo_id
,uo.localizacion_id as localizacion_id
,n.nombre
,car.nombre
,car.oferta_educativa_id
from Fd.establecimiento e 
inner join Fd.unidad_educativa ue on ue.establecimiento_id= e.id
inner join Fd.nivel n on ue.nivel_id=n.id
inner join Fd.unidad_oferta uo on uo.unidad_educativa_id=ue.id
inner join Fd.oferta_educativa oe on oe.id=uo.oferta_educativa_id
inner join Fd.carrera car on car.oferta_educativa_id=oe.id
where ue.id=103
order by e.apodo