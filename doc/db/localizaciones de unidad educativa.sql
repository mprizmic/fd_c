--- me da las localizaciones de una unidad educativa con sus domicilios

select e.apodo, e.id as e_id, 
ue.id as unidad_educativa
,l.id as localizacion_id
,d.calle , d.altura
from Fd.establecimiento e 
inner join Fd.unidad_educativa ue on ue.establecimiento_id= e.id
inner join Fd.nivel n on ue.nivel_id=n.id
inner join Fd.localizacion l on l.unidad_educativa_id=ue.id
inner join Fd.domicilio_localizacion dl on dl.localizacion_id=l.id
inner join Fd.domicilio d on d.id=dl.domicilio_id
where ue.id=103
order by e.apodo

