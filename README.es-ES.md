

# lexorank

> Una implementación sencilla en PHP de [xissy/lexorank](https://github.com/xissy/lexorank)

LexoRank es un sistema de ordenación introducido por Atlassian JIRA.
  * <https://www.youtube.com/watch?v=OjQv9xMoFbg>

## Antecedentes
¿Cuál es la mejor representación de una lista ordenada en una base de datos?
Con un sistema de ordenación básico basado en números de orden, reordenar una fila de una
lista puede requerir actualizar todas las filas de la lista en una transacción,
lo cual es O(n).
  * <https://stackoverflow.com/questions/9536262/best-representation-of-an-ordered-list-in-a-database/49956113>
  * <https://softwareengineering.stackexchange.com/questions/195308/storing-a-re-orderable-list-in-a-database>

LexoRank lo reduce a O(1). Todo lo que necesitas hacer es actualizar el campo de orden de la fila
reordenada.
