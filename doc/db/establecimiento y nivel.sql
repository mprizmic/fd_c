select e.apodo, e.id, ue.id, n.nombre
from Fd.unidad_educativa ue 
INNER JOIN Fd.establecimiento e on e.id=ue.establecimiento_id
inner join Fd.nivel n on n.id=ue.nivel_id
