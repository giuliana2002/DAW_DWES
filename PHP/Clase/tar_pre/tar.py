import binascii

def decode_hex_lines(file_path):
    """
    Lee un archivo línea por línea e intenta decodificar las cadenas hexadecimales.
    """
    with open(file_path, 'rb') as file:
        lines = file.readlines()
    
    decoded_lines = []
    for line in lines:
        try:
            # Intentar decodificar líneas hexadecimales
            decoded_line = binascii.unhexlify(line.strip())
            decoded_lines.append(decoded_line)
        except binascii.Error:
            # Si no es hex, añadir como está
            decoded_lines.append(line.strip())
    return decoded_lines

def brute_force_xor(data):
    """
    Prueba todas las claves posibles de 0 a 255 para descifrar un bloque de datos usando XOR.
    """
    results = {}
    for key in range(256):
        # XOR cada byte con la clave
        decrypted = bytes([b ^ key for b in data])
        # Guardar resultado para esta clave
        results[key] = decrypted
    return results

# Ruta del archivo
file_path = "/ruta/a/tu/archivo.mct"

# Decodificar líneas del archivo
decoded_lines = decode_hex_lines(file_path)

# Probar todas las claves para cada línea decodificada
for i, line in enumerate(decoded_lines):
    if isinstance(line, bytes):  # Solo trabajar con datos binarios
        print(f"\n--- Descifrando bloque {i} ---")
        brute_force_results = brute_force_xor(line)
        for key, result in brute_force_results.items():
            try:
                # Imprimir solo resultados con texto legible
                print(f"Clave {key}: {result.decode('utf-8', errors='ignore')}")
            except UnicodeDecodeError:
                # Ignorar resultados no legibles
                continue
    else:
        print(f"Bloque {i}: {line.decode() if isinstance(line, bytes) else line}")
