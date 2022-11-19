<div class="form-check">
    <table>
        <tr>
            <th textalign="left">

                <label class="form-check-label" for="{{ $id }}">
                    {{ $location }}
                </label>
            </th>
            <th textalign="right">

                <label for="X">X:</label>
                <input type="number" id="X" name="X"
                       min="0" >
            </th>
            <th textalign="right">

                <label for="Y">Y:</label>
                <input type="number" id="Y" name="Y"
                       min="0" >
            </th>
            <th textalign="right">

                <label for="Z">Z:</label>
                <input type="number" id="Z" name="Z"
                       min="0" >
            </th>
            <th textalign="right">
                <input id="{{ $id }}" class="form-check-input" wire:model="isAvailableInLocation" wire:click="addLocation"
                       type="checkbox">
            </th>
        </tr>
    </table>
</div>

<style>


    table {
        border-collapse: collapse;
        width: 100%;
        height: 50%;
    }

    td {

        vertical-align: text-bottom;
    }

    input[type='checkbox'] {
        -webkit-appearance:none;
        width:30px;
        height:30px;
        background:white;
        border-radius:5px;
        border:2px solid #555;
    }
    input[type='checkbox']:checked {
        background: #abd;
    }
</style>

