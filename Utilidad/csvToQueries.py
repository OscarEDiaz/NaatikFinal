# Programa para transformar archivo CSV a queries
import csv
import random

fl = open("Utilidad/clientquerys.sql", 'w')
fl.write("insert into naatik_clientes values\n")

csvFile = open("Utilidad/churn_test.csv", "r")
csvFile = csv.DictReader(csvFile)

servTelefono = {
    "No" : 0,
    "Si" : 1,
    "Sin servicio de teléfono" : 2
}

tipoInternet = {
    "No" : 0,
    "DSL" : 1,
    "Fibra optica" : 2
}

servInternet = {
    "No" : 0,
    "Si" : 1,
    "Sin servicio de internet" : 2
}

contracto = {
    "Mes a mes" : 1,
    "Un año" : 2,
    "Dos años" : 3
}

pago = {
    "Tarjeta de credito (automatico)" : 1,
    "Transferencia bancaria (automatico)" : 2,
    "Cheque electronico" : 3,
    "Cheque por correo" : 4
}

for line in csvFile:
    query = "(" + f"\"{line['ClienteID']}\"" + ",\t"
    query += str(1) if line['Genero'] == "Si" else str(0) + ",\t"
    query += line['EsJubilado'] + ",\t"
    query += str(1) if line['TienePareja'] == "Si" else str(0) + ",\t"
    query += str(1) if line['TieneDependientes'] == "Si" else str(0) + ",\t"
    query += str(line['MesesComoCliente']) + ",\t"
    query += str(1) if line['TieneServicioDeTelefono'] == "Si" else str(0) + ",\t"
    query += str(servTelefono[line['TieneMultiplesLineas']]) + ",\t"
    query += str(tipoInternet[line['ServicioInternet']]) + ",\t"
    query += str(servInternet[line['SeguridadEnLinea']]) + ",\t"
    query += str(servInternet[line['BackupEnLinea']]) + ",\t"
    query += str(servInternet[line['ProteccionDeDispositivo']]) + ",\t"
    query += str(servInternet[line['SoporteTecnico']]) + ",\t"
    query += str(servInternet[line['StreamingTV']]) + ",\t"
    query += str(servInternet[line['StreamingPeliculas']]) + ",\t"
    query += str(contracto[line['Contracto']]) + ",\t"
    query += str(1) if line['FacturaElectronica'] == "Si" else str(0) + ",\t"
    query += str(pago[line['MetodoDePago']]) + ",\t"
    query += str(line['CargoMensual']) + ",\t"
    query += str(line['CargosTotales']) + ",\t"
    query += str(random.randint(0,10000) / 100) + "),\n"

    fl.write(query)

fl.write(";")