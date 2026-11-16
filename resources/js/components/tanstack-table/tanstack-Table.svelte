<script>
  import {
    createSortedRowModel,
    createTable,
    FlexRender,
    tableFeatures,
    sortFns,
    rowSortingFeature
  } from '@tanstack/svelte-table'

  // 1. Recebe os dados do Inertia via props (Svelte 5)
  let { users = [] } = $props()

  // 2. Declara quais features a tabela usa (nenhuma extra por enquanto)
  const features = tableFeatures({
      rowSortingFeature,
      sortedRowModel: createSortedRowModel(),
      sortFns,
  })

  // 3. Define as colunas
  const columns = [
    {
      accessorKey: 'name',
      header: 'Nome',
      cell: (info) => info.getValue(),
    },
    {
      accessorKey: 'email',
      header: 'E-mail',
      cell: (info) => info.getValue(),
    },
    {
      accessorKey: 'created_at',
      header: 'Data de Criação',
      cell: (info) =>
        new Date(info.getValue()).toLocaleDateString('pt-BR'),
    },
  ]

  // 4. Cria a instância da tabela
  // O getter mantém a tabela sincronizada com as props do Inertia
  const table = createTable({
    features,
    columns,
    get data() {
      return users
    },
  })
</script>

<!-- 5. Renderização com as classes do Bootstrap 5.3 -->
<div class="table-responsive">
  <table class="table table-striped table-hover table-bordered align-middle">
    <thead class="table-dark">
      {#each table.getHeaderGroups() as headerGroup (headerGroup.id)}
        <tr>
          {#each headerGroup.headers as header (header.id)}
            <th scope="col">
              {#if !header.isPlaceholder}
                <FlexRender {header} />
              {/if}
            </th>
          {/each}
        </tr>
      {/each}
    </thead>
    <tbody>
      {#each table.getRowModel().rows as row (row.id)}
        <tr>
          {#each row.getAllCells() as cell (cell.id)}
            <td>
              <FlexRender {cell} />
            </td>
          {/each}
        </tr>
      {/each}
    </tbody>
  </table>
</div>