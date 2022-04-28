# Programa para transformar archivo CSV a queries
import csv
import random

fl = open("querys.sql", 'w')
fl.write("insert into naatik_clientes values\n")

csvFile = open("churn_test.csv", "r")
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
    query = "(" + f"\"{line['ClienteID']}\"" + ","
    query += str(1) if line['Genero'] == "Si" else str(0) + ","
    query += line['EsJubilado'] + ","
    query += str(1) if line['TienePareja'] == "Si" else str(0) + ","
    query += str(1) if line['TieneDependientes'] == "Si" else str(0) + ","
    query += str(line['MesesComoCliente']) + ","
    query += str(1) if line['TieneServicioDeTelefono'] == "Si" else str(0) + ","
    query += str(servTelefono[line['TieneMultiplesLineas']]) + ","
    query += str(tipoInternet[line['ServicioInternet']]) + ","
    query += str(servInternet[line['SeguridadEnLinea']]) + ","
    query += str(servInternet[line['BackupEnLinea']]) + ","
    query += str(servInternet[line['ProteccionDeDispositivo']]) + ","
    query += str(servInternet[line['SoporteTecnico']]) + ","
    query += str(servInternet[line['StreamingTV']]) + ","
    query += str(servInternet[line['StreamingPeliculas']]) + ","
    query += str(contracto[line['Contracto']]) + ","
    query += str(1) if line['FacturaElectronica'] == "Si" else str(0) + ","
    query += str(pago[line['MetodoDePago']]) + ","
    query += str(line['CargoMensual']) + ","
    query += str(line['CargosTotales']) + ","
    query += str(random.randint(0,10000) / 100) + "),\n"

    fl.write(query)

fl.write(";")