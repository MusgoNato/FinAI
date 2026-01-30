<select name="category" class="select select-bordered w-full" required>
    <option value="Alimentacao" @selected($selected === 'Alimentacao')>
        Alimentação
    </option>

    <option value="Renda" @selected($selected === 'Renda')>
        Renda
    </option>
    <option value="Transporte" @selected($selected === 'Transporte')>
        Transporte
    </option>
    <option value="Lazer" @selected($selected === 'Lazer')>
        Lazer
    </option>
    <option value="Outros" @selected($selected === 'Outros')>
        Outros
    </option>
</select>
