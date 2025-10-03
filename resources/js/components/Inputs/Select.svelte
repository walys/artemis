<script>
    import { createEventDispatcher, onMount } from 'svelte';
    // import api from "$svelte/src/lib/services/Api";
    import Select from 'svelte-select';
	// import { id } from 'date-fns/locale';

    /**
     * docs: https://www.npmjs.com/package/svelte-select
     * https://svelte-select-examples.vercel.app/examples
     */


    export let value = undefined;
    export let justValue = undefined;
    export let items = [];
    export let ignoreItemsIds = [];
    export let url = "";
    export let orderBy = "name";
    export let colored = false;
    export let searchable = true;
    export let clearable = false;
    export let placeholder = "Selecione";
    export let creatable = false;
    export let ajaxParams = undefined;
    export let clearOnSelected = false;
    export let hasError = false;
    export { classInput as class };
    export let defaultValue = null;
    export let startOpen = false;
    export let preload = false;
    export let disabled = false;
    export let showId = null;
    export let showIcon = false;
    export let multiple = false;
    export let dropdownMode = true;
    export let title = '';
    export let itemId = 'id';
    export let label = 'name';
    export let isValid = undefined;
    /*
    Este componente deve receber obrigatoriamente um array de objetos com id e name
    o value pode ser um objeto com id e name ou apenas o id como string ou number
    */

    let classInput = "";
    let isOpen = false;
    let searchValue = "";
    let itemsFiltered = items;
    let searching = false;
    let filtering = false;

    const dispatch = createEventDispatcher();

    onMount(async () => {
        if(startOpen){
            toggleDropdown();
        }
        if(defaultValue && !value){
            loadOptions(true)
        };

    });


    function toggleDropdown(e) {
        if (disabled) return;

        setTimeout(() => {
            isOpen = !isOpen;
            loadOptions(true);
        }, 300);
    }

    // hack para permitir filtro de busca
    $: if(searchValue.length > 0){
        // aplica um delay de antes de pesquisar
        handleFilter();
        // if(!filtering){
        //     setTimeout(() => {
        //         handleFilter();
        //     }, 1000);
        // }
        filtering = true;
    }
    function handleFilter(){
        loadOptions(true);
        filtering = false;
    }


    // busca ajax e filtra no servidor
    async function handleAjaxSearch(){
        try{

            searching = true;

            let params = {
                searchText: searchValue,
                limit: 50
            };
            params = new URLSearchParams(params).toString();
            if(ajaxParams) params = params + '&' + new URLSearchParams(ajaxParams).toString();

            let concatenator = url.includes('?') ? '&' : '?';

            let result = await api.get(url + concatenator + params);

            itemsFiltered = await result.data;

            searching = false;

            // ordena os itens
            itemsFiltered = itemsFiltered.sort((a, b) => {
                if (a[orderBy] < b[orderBy]) {
                    return -1;
                }
                if (a[orderBy] > b[orderBy]) {
                    return 1;
                }
                return 0;
            });

            itemsFiltered = itemsFiltered;

            if(defaultValue){
                value = itemsFiltered.find(item => item.id == defaultValue);
            }
            if (ignoreItemsIds.length > 0) {
                itemsFiltered = itemsFiltered.filter(item => !ignoreItemsIds.includes(item.id));
            }

            return itemsFiltered;

        }catch(e){
            itemsFiltered = [
                {value: 0, label: 'Erro ao buscar'}
            ];
        }
    }

    // ao selecionar
    function handleChange(option) {
        if(clearOnSelected){
            value = undefined;
            justValue = null;
        }
        dispatch('change', option.detail);
    }


    function handleClear({detail}){
        value = undefined;
        justValue = null;
        dispatch('clear', detail);
    }

    async function loadOptions(forceAjax = false){
        if(items.length > 0){
            itemsFiltered = items;
            return itemsFiltered;
        }
        if((preload || forceAjax) && url !== "") {
            return await handleAjaxSearch();
        }else{
            return [];
        }
    }


</script>
<div class="select-container" class:is-invalid={hasError} class:is-valid={isValid} class:dropdown-mode={dropdownMode} {title}>
    <Select
        bind:items={itemsFiltered}
        loading={searching}
        bind:value
        bind:justValue
        bind:filterText={searchValue}
        bind:isOpen
        on:change={handleChange}
        on:focus={toggleDropdown}
        on:clear={handleClear}
        debounceWait="0"
        {itemId}
        {label}
        {searchable}
        {clearable}
        {placeholder}
        class="form-control {classInput}"
        {multiple}
        {disabled}
        {hasError}
        floatingConfig={{
            strategy: 'fixed'
        }}
    >
        <div slot="selection" let:selection let:index>
            <slot name="selection" {selection}>
                <span class="selected-text text-{colored ? selection?.color : ''}" style="{colored ? `color: ${selection?.color}` : ''}">
                    {#if showIcon}
                        <i class="{selection.icon} mr-2"></i>
                    {/if}

                    <span class="text-{selection.color}" style="color: {selection.color ? selection.color : ''}">
                        {selection.name}
                    </span>

                    {#if showId}
                        <span class="text-muted ml-1 italic small">
                            #{selection[showId]}
                        </span>
                    {/if}
                </span>
            </slot>
        </div>
        <div slot="item" let:item class:text-muted={item.disabled}>
            <slot name="item" {item}>
                <span class="text-{item.color}" style="color: {item.color ? item.color : ''}">
                    {#if showIcon}
                        <i class="{item.icon} mr-2"></i>
                    {/if}

                    {item.name}
                </span>

                {#if showId}
                    <span class="text-muted ml-1 italic small">
                        #{item[showId]}
                    </span>
                {/if}
            </slot>
        </div>
        <input type="hidden" name="" class:is-invalid={hasError}>
    </Select>
</div>


<style lang="scss">
    .select-container{
        --height: 39px;
        --font-size: 0.92rem;
    }
    :global(.select-container .error){
        border-color: #dc3545 !important;
    }
    :global(.dropdown-mode .svelte-select){
        cursor: pointer !important;
        &:hover{
            background-color: #f3f6f9 !important;
        }
    }
    :global(.dropdown-mode .svelte-select input){
        cursor: pointer !important;
    }

</style>
