--- oferta de una unidad educativa sin localizacion
select e.apodo, e.id as e_id, 
ue.id as unidad_educativa
,uo.id as uo_id
, uo.tipo
,n.nombre
,l.id as l_id
from Fd.establecimiento e 
inner join Fd.unidad_educativa ue on ue.establecimiento_id= e.id
inner join Fd.nivel n on ue.nivel_id=n.id
INNER JOIN Fd.localizacion l on l.unidad_educativa_id=ue.id
left join Fd.unidad_oferta uo on uo.localizacion_id=l.id
left join Fd.oferta_educativa oe on oe.id=uo.oferta_educativa_id
where e.apodo="ENS 1"
order by e.apodo