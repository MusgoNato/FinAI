<select name="category" class="select select-bordered w-full" required>
    <option value="Despesa" @selected($selected === 'Despesa')>
        Despesa
    </option>

    <option value="Receita" @selected($selected === 'Receita')>
        Receita
    </option>
</select>
