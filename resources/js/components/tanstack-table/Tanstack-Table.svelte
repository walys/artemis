<script>
  import { createTable, FlexRender, tableFeatures } from '@tanstack/svelte-table';

  // Receber dados do Inertia (Svelte 5)
  let { users = [] } = $props();
  console.log('dasdasd')
  const columns = [
    { accessorKey: 'name', header: 'Nome' },
    { accessorKey: 'email', header: 'E-mail' },
    {
      accessorKey: 'created_at',
      header: 'Data de Criação',
      cell: (info) => new Date(info.getValue()).toLocaleDateString('pt-BR')
    }
  ];

  // v9: tableFeatures deve ser passado explicitamente
  const table = createTable({
    features: tableFeatures({}),
    columns,
    get data() {
      return users; // O getter garante que a tabela acompanhe as mudanças nas props do Inertia
    }
  });
</script>

<div class="table-responsive">
  <table class="table table-striped table-hover table-bordered">
    <thead class="table-dark">
      {#each table.getHeaderGroups() as headerGroup (headerGroup.id)}
        <tr>
          {#each headerGroup.headers as header (header.id)}
            <th scope="col">
              {#if !header.isPlaceholder}
                <FlexRender content={header.column.columnDef.header} context={header.getContext()} />
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
              <FlexRender content={cell.column.columnDef.cell} context={cell.getContext()} />
            </td>
          {/each}
        </tr>
      {/each}
    </tbody>
  </table>
</div>