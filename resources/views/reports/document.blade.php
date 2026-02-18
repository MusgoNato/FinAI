<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório Financeiro</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 12px;
            color: #777;
        }

        .filters {
            margin-bottom: 15px;
            padding: 10px;
            background: #f4f4f4;
            border-radius: 5px;
        }

        .filters span {
            display: inline-block;
            margin-right: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th {
            background: #2c3e50;
            color: white;
            padding: 8px;
            text-align: left;
        }

        table td {
            padding: 6px;
            border-bottom: 1px solid #ddd;
        }

        .text-right {
            text-align: right;
        }

        .income {
            color: #27ae60;
            font-weight: bold;
        }

        .expense {
            color: #c0392b;
            font-weight: bold;
        }

        .totals {
            margin-top: 20px;
            padding: 10px;
            border-top: 2px solid #333;
        }

        .totals div {
            margin-bottom: 5px;
        }

        .saldo {
            font-size: 14px;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            font-size: 10px;
            text-align: center;
            color: #999;
        }
    </style>
</head>

<body>

    <!-- Cabeçalho -->
    <div style="margin-bottom: 15px;">
        <span><strong>Período:</strong>
            {{ $filters['start_date'] }} até {{ $filters['end_date'] }}
        </span>
        <br>

        <span><strong>Tipo:</strong>
            {{ $filters['type'] ?? 'Todos' }}
        </span>
        <br>

        <span><strong>Categoria:</strong>
            {{ $filters['category'] ?? 'Todas' }}
        </span>
        <br>

        <span><strong>Ordenação:</strong>
            @switch($filters['sort_by'] ?? '')
                @case('date_desc') Mais recentes @break
                @case('date_asc') Mais antigas @break
                @case('amount_desc') Maior valor @break
                @case('amount_asc') Menor valor @break
                @default Padrão
            @endswitch
        </span>
    </div>

    <!-- Tabela de Transações -->
    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Tipo</th>
                <th class="text-right">Valor</th>
            </tr>
        </thead>
        <tbody>


            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($transaction->date)->format('d/m/Y') }}</td>
                    <td>{{ $transaction->description }}</td>
                    <td>{{ $transaction->category }}</td>
                    <td>{{ $transaction->type }}</td>
                    <td class="text-right {{ $transaction->type === 'Receita' ? 'Receita' : 'Despesa' }}">
                        R$ {{ number_format($transaction->price, 2, ',', '.') }}
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <!-- Totais -->
    <div class="totals">
        <div>💰 Total de Receitas:
            <span class="income">
                R$ {{ number_format($total_income, 2, ',', '.') }}
            </span>
        </div>

        <div>💸 Total de Despesas:
            <span class="expense">
                R$ {{ number_format($total_expense, 2, ',', '.') }}
            </span>
        </div>

        <div class="saldo">
            📊 Saldo Final:
            R$ {{ number_format($total_balance, 2, ',', '.') }}
        </div>
    </div>

    <!-- Rodapé -->
    <div class="footer">
        Documento gerado em {{ now()->format('d/m/Y H:i') }}
    </div>

</body>
</html>
