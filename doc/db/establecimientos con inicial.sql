---- establecimientos con inicial pero sin unidad_oferta
select e.apodo, e.id as e_id, ue.id as unidad_educativa, uo.id as unidad_oferta, ix.id as ix_id
from Fd.establecimiento e 
inner join Fd.unidad_educativa ue on ue.establecimiento_id= e.id
inner join Fd.unidad_oferta uo on ue.id=uo.unidad_educativa_id
inner join Fd.inicial_x ix on ix.unidad_oferta_id=uo.id
where ue.nivel_id=29 
and e.apodo="ENS 5"

order by e.orden


