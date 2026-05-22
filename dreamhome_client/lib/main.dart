import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

void main() {
  runApp(const DreamHomeApp());
}

class DreamHomeApp extends StatelessWidget {
  const DreamHomeApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'DreamHome Client',
      theme: ThemeData(
        primarySwatch: Colors.blue,
      ),
      home: const PropertyScreen(),
    );
  }
}

class PropertyScreen extends StatefulWidget {
  const PropertyScreen({super.key});

  @override
  State<PropertyScreen> createState() => _PropertyScreenState();
}

class _PropertyScreenState extends State<PropertyScreen> {
  List<dynamic> properties = [];
  bool isLoading = true;

  final String baseUrl = 'http://10.0.2.2:8000/api';

  @override
  void initState() {
    super.initState();
    fetchProperties();
  }

  Future<void> fetchProperties() async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl/properties'),
        headers: {
          'Accept': 'application/json',
        },
      );

      if (response.statusCode == 200) {
        final List<dynamic> data = jsonDecode(response.body);

        setState(() {
          properties = data;
          isLoading = false;
        });
      } else {
        setState(() {
          isLoading = false;
        });
      }
    } catch (e) {
      print("Error: $e");

      setState(() {
        isLoading = false;
      });
    }
  }

  Future<void> requestViewing(String propertyId) async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/viewings'),
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
        body: jsonEncode({
          'client_id': 'CL001',
          'property_id': propertyId,
          'view_date': '2026-05-25',
          'staff_id': 'ST0016',
        }),
      );

      if (!mounted) return;

      if (response.statusCode == 200) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            content: Text('Viewing request submitted!'),
          ),
        );
      } else {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text('Failed: ${response.statusCode}'),
          ),
        );
      }
    } catch (e) {
      if (!mounted) return;

      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text('Error: $e'),
        ),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('DreamHome Properties'),
        centerTitle: true,
      ),
      body: isLoading
          ? const Center(
              child: CircularProgressIndicator(),
            )
          : properties.isEmpty
              ? const Center(
                  child: Text(
                    'No properties found',
                    style: TextStyle(fontSize: 18),
                  ),
                )
              : ListView.builder(
                  itemCount: properties.length,
                  itemBuilder: (context, index) {
                    final property = properties[index];

                    return Card(
                      margin: const EdgeInsets.symmetric(
                        horizontal: 12,
                        vertical: 8,
                      ),
                      elevation: 4,
                      child: ListTile(
                        title: Text(
                          property['property_id'].toString(),
                          style: const TextStyle(
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                        subtitle: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Text(
                              'Type: ${property['type']}',
                            ),
                            Text(
                              'City: ${property['city']}',
                            ),
                            Text(
                              'Rooms: ${property['rooms']}',
                            ),
                            Text(
                              'Rent: ${property['monthly_rent']}',
                            ),
                            Text(
                              'Status: ${property['status']}',
                            ),
                          ],
                        ),
                        trailing: ElevatedButton(
                          onPressed: () {
                            requestViewing(
                              property['property_id'].toString(),
                            );
                          },
                          child: const Text('Request'),
                        ),
                      ),
                    );
                  },
                ),
    );
  }
}