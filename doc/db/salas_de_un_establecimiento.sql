select e.apodo, ue.id, n.abreviatura
from Fd.unidad_educativa ue
inner join Fd.establecimiento e on e.id=ue.establecimiento_id
inner join Fd.nivel n on n.id=ue.nivel_id

where n.id=29
and e.apodo="Romero"
