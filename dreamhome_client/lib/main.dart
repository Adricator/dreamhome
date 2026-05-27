import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';
import 'dart:convert';
import 'package:flutter/services.dart';

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
        useMaterial3: true,
        scaffoldBackgroundColor: DreamHomeColors.accent,
        colorScheme: ColorScheme.fromSeed(
          seedColor: DreamHomeColors.primary,
          primary: DreamHomeColors.primary,
        ),
      ),
      home: const LoginScreen(),
    );
  }
}

class ApiConfig {
  
  static const String baseUrl = 'http://10.0.2.2:8000/api';
}

class DreamHomeColors {
  static const Color primary = Color(0xFF2F5563);
  static const Color secondary = Color(0xFF3F6775);
  static const Color accent = Color(0xFFEFF4F7);
  static const Color textDark = Color(0xFF1F2E35);
  static const Color textLight = Colors.white;
  static const Color muted = Color(0xFF6B7C85);
}

InputDecoration inputDecoration({
  required String label,
  required IconData icon,
  Widget? suffixIcon,
}) {
  return InputDecoration(
    labelText: label,
    prefixIcon: Icon(
      icon,
      color: DreamHomeColors.primary,
    ),
    suffixIcon: suffixIcon,
    filled: true,
    fillColor: const Color(0xFFF7FAFC),
    border: OutlineInputBorder(
      borderRadius: BorderRadius.circular(14),
      borderSide: BorderSide.none,
    ),
    enabledBorder: OutlineInputBorder(
      borderRadius: BorderRadius.circular(14),
      borderSide: BorderSide.none,
    ),
    focusedBorder: OutlineInputBorder(
      borderRadius: BorderRadius.circular(14),
      borderSide: const BorderSide(
        color: DreamHomeColors.primary,
        width: 1.5,
      ),
    ),
  );
}

ButtonStyle primaryButtonStyle() {
  return ElevatedButton.styleFrom(
    backgroundColor: DreamHomeColors.primary,
    foregroundColor: Colors.white,
    elevation: 3,
    shape: RoundedRectangleBorder(
      borderRadius: BorderRadius.circular(14),
    ),
  );
}

class LoginScreen extends StatefulWidget {
  const LoginScreen({super.key});

  @override
  State<LoginScreen> createState() => _LoginScreenState();
}

class _LoginScreenState extends State<LoginScreen> {
  final TextEditingController emailController = TextEditingController();
  final TextEditingController passwordController = TextEditingController();

  bool isLoading = false;
  bool hidePassword = true;

  Future<void> loginClient() async {
    if (emailController.text.isEmpty || passwordController.text.isEmpty) {
      showMessage('Please enter email and password.');
      return;
    }

    setState(() {
      isLoading = true;
    });

    try {
      final response = await http.post(
        Uri.parse('${ApiConfig.baseUrl}/client/login'),
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
        },
        body: jsonEncode({
          'email': emailController.text.trim(),
          'password': passwordController.text.trim(),
        }),
      );

      final data = jsonDecode(response.body);

      if (response.statusCode == 200) {
        final String? token = data['token'] ?? data['access_token'];

        if (token == null) {
          showMessage('Login worked, but no token was returned.');
          return;
        }

        final prefs = await SharedPreferences.getInstance();
        await prefs.setString('token', token);

        final client = data['client'];

        final firstName = client != null && client['first_name'] != null
            ? client['first_name'].toString()
            : 'Client';

        final clientId = client != null && client['client_id'] != null
            ? client['client_id'].toString()
            : '';

        final maxRent = client != null && client['max_rent'] != null
            ? client['max_rent'].toString()
            : '0';

        await prefs.setString('first_name', firstName);
        await prefs.setString('client_id', clientId);
        await prefs.setString('max_rent', maxRent);

        if (!mounted) return;

        Navigator.pushReplacement(
          context,
          MaterialPageRoute(
            builder: (context) => const ClientHomeScreen(),
          ),
        );
      } else {
        showMessage(data['message'] ?? 'Login failed. Check your account.');
      }
    } catch (e) {
      showMessage('Connection error: $e');
    } finally {
      if (mounted) {
        setState(() {
          isLoading = false;
        });
      }
    }
  }

  void showMessage(String message) {
    if (!mounted) return;

    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        content: Text(message),
        backgroundColor: DreamHomeColors.primary,
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        width: double.infinity,
        height: double.infinity,
        decoration: const BoxDecoration(
          gradient: LinearGradient(
            begin: Alignment.topCenter,
            end: Alignment.bottomCenter,
            colors: [
              DreamHomeColors.primary,
              DreamHomeColors.secondary,
              DreamHomeColors.accent,
            ],
            stops: [0.0, 0.38, 1.0],
          ),
        ),
        child: Center(
          child: SingleChildScrollView(
            padding: const EdgeInsets.all(24),
            child: Card(
              elevation: 10,
              color: Colors.white,
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(26),
              ),
              child: Padding(
                padding: const EdgeInsets.all(26),
                child: Column(
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    CircleAvatar(
                      radius: 42,
                      backgroundColor:
                          DreamHomeColors.primary.withValues(alpha: 0.12),
                      child: const Icon(
                        Icons.home_work_rounded,
                        size: 46,
                        color: DreamHomeColors.primary,
                      ),
                    ),
                    const SizedBox(height: 16),
                    const Text(
                      'dream',
                      style: TextStyle(
                        fontSize: 44,
                        fontWeight: FontWeight.w300,
                        letterSpacing: 2,
                        color: DreamHomeColors.primary,
                      ),
                    ),
                    const Text(
                      'H O M E',
                      style: TextStyle(
                        fontSize: 28,
                        fontWeight: FontWeight.w500,
                        letterSpacing: 10,
                        color: DreamHomeColors.textDark,
                      ),
                    ),
                    const SizedBox(height: 8),
                    const Text(
                      'Client Login',
                      style: TextStyle(
                        fontSize: 16,
                        color: DreamHomeColors.muted,
                      ),
                    ),
                    const SizedBox(height: 30),
                    TextField(
                      controller: emailController,
                      keyboardType: TextInputType.emailAddress,
                      decoration: inputDecoration(
                        label: 'Email',
                        icon: Icons.email_outlined,
                      ),
                    ),
                    const SizedBox(height: 16),
                    TextField(
                      controller: passwordController,
                      obscureText: hidePassword,
                      decoration: inputDecoration(
                        label: 'Password',
                        icon: Icons.lock_outline,
                        suffixIcon: IconButton(
                          icon: Icon(
                            hidePassword
                                ? Icons.visibility_off
                                : Icons.visibility,
                            color: DreamHomeColors.primary,
                          ),
                          onPressed: () {
                            setState(() {
                              hidePassword = !hidePassword;
                            });
                          },
                        ),
                      ),
                    ),
                    const SizedBox(height: 24),
                    SizedBox(
                      width: double.infinity,
                      height: 52,
                      child: ElevatedButton(
                        onPressed: isLoading ? null : loginClient,
                        style: primaryButtonStyle(),
                        child: isLoading
                            ? const CircularProgressIndicator(
                                color: Colors.white,
                              )
                            : const Text(
                                'LOGIN',
                                style: TextStyle(
                                  fontSize: 16,
                                  fontWeight: FontWeight.bold,
                                  letterSpacing: 1,
                                ),
                              ),
                      ),
                    ),
                    const SizedBox(height: 16),
                    const Text(
                      'Login as a DreamHome client to view properties and request viewings.',
                      textAlign: TextAlign.center,
                      style: TextStyle(
                        color: DreamHomeColors.muted,
                      ),
                    ),
                    const SizedBox(height: 12),
                    TextButton(
                      onPressed: () {
                        Navigator.push(
                          context,
                          MaterialPageRoute(
                            builder: (context) => const RegisterScreen(),
                          ),
                        );
                      },
                      child: const Text(
                        'No account yet? Register here',
                        style: TextStyle(
                          color: DreamHomeColors.primary,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                    ),
                  ],
                ),
              ),
            ),
          ),
        ),
      ),
    );
  }
}

class RegisterScreen extends StatefulWidget {
  const RegisterScreen({super.key});

  @override
  State<RegisterScreen> createState() => _RegisterScreenState();
}

class _RegisterScreenState extends State<RegisterScreen> {
  final TextEditingController firstNameController = TextEditingController();
  final TextEditingController lastNameController = TextEditingController();
  final TextEditingController addressController = TextEditingController();
  final TextEditingController telephoneController = TextEditingController();
  final TextEditingController emailController = TextEditingController();
  final TextEditingController passwordController = TextEditingController();
  final TextEditingController maxRentController = TextEditingController();

  String? selectedPreferType;

  final List<String> propertyTypes = [
    'apartment',
    'house',
    'condo',
    'studio',
    'flat',
  ];

  bool isLoading = false;
  bool hidePassword = true;

  @override
  void initState() {
    super.initState();
    maxRentController.text = '2,000';
  }

  int getMaxRentValue() {
    final cleanText = maxRentController.text.replaceAll(',', '').trim();

    if (cleanText.isEmpty) {
      return 2000;
    }

    final value = int.tryParse(cleanText) ?? 2000;

    if (value < 2000) {
      return 2000;
    }

    return value;
  }

  String formatRent(int value) {
    final text = value.toString();
    final buffer = StringBuffer();

    for (int i = 0; i < text.length; i++) {
      final positionFromEnd = text.length - i;

      buffer.write(text[i]);

      if (positionFromEnd > 1 && positionFromEnd % 3 == 1) {
        buffer.write(',');
      }
    }

    return buffer.toString();
  }

  void setMaxRentValue(int value) {
    if (value < 2000) {
      value = 2000;
    }

    maxRentController.text = formatRent(value);
    maxRentController.selection = TextSelection.fromPosition(
      TextPosition(offset: maxRentController.text.length),
    );
  }

  void increaseMaxRent() {
    final currentValue = getMaxRentValue();
    setMaxRentValue(currentValue + 500);
  }

  void decreaseMaxRent() {
    final currentValue = getMaxRentValue();
    setMaxRentValue(currentValue - 500);
  }

  void formatMaxRentInput(String value) {
    final cleanText = value.replaceAll(',', '').trim();

    if (cleanText.isEmpty) {
      return;
    }

    final number = int.tryParse(cleanText);

    if (number == null) {
      return;
    }

    final formatted = formatRent(number);

    if (formatted != value) {
      maxRentController.value = TextEditingValue(
        text: formatted,
        selection: TextSelection.collapsed(offset: formatted.length),
      );
    }
  }

  Future<void> registerClient() async {
    if (firstNameController.text.isEmpty ||
        lastNameController.text.isEmpty ||
        emailController.text.isEmpty ||
        passwordController.text.isEmpty) {
      showMessage('Please fill in first name, last name, email, and password.');
      return;
    }

    final password = passwordController.text.trim();

    final passwordRegex = RegExp(
      r'^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z0-9]).+$',
    );

    if (password.length < 6) {
      showMessage('Password must be at least 6 characters long.');
      return;
    }

    if (!passwordRegex.hasMatch(password)) {
      showMessage(
        'Password must contain at least one letter, one number, and one special character.',
      );
      return;
    }

    if (selectedPreferType == null) {
      showMessage('Please select your preferred property type.');
      return;
    }

    setState(() {
      isLoading = true;
    });

    try {
      final response = await http.post(
        Uri.parse('${ApiConfig.baseUrl}/client/register'),
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
        },
        body: jsonEncode({
          'first_name': firstNameController.text.trim(),
          'last_name': lastNameController.text.trim(),
          'address': addressController.text.trim().isEmpty
              ? null
              : addressController.text.trim(),
          'telephone_no': telephoneController.text.trim().isEmpty
              ? null
              : telephoneController.text.trim(),
          'email': emailController.text.trim(),
          'password': password,
          'prefer_type': selectedPreferType,
          'max_rent': double.tryParse(
            maxRentController.text.replaceAll(',', '').trim(),
          ),
        }),
      );

      final data = jsonDecode(response.body);

      if (response.statusCode == 200 || response.statusCode == 201) {
        final String? token = data['token'] ?? data['access_token'];

        if (token == null) {
          showMessage('Registered, but no token was returned.');
          return;
        }

        final client = data['client'];

        final firstName = client != null && client['first_name'] != null
            ? client['first_name'].toString()
            : firstNameController.text.trim();

        final clientId = client != null && client['client_id'] != null
            ? client['client_id'].toString()
            : '';

        final maxRent = client != null && client['max_rent'] != null
            ? client['max_rent'].toString()
            : maxRentController.text.replaceAll(',', '').trim();

        final prefs = await SharedPreferences.getInstance();
        await prefs.setString('token', token);
        await prefs.setString('first_name', firstName);
        await prefs.setString('client_id', clientId);
        await prefs.setString('max_rent', maxRent);

        if (!mounted) return;

        showMessage('Registration successful!');

        Navigator.pushAndRemoveUntil(
          context,
          MaterialPageRoute(
            builder: (context) => const ClientHomeScreen(),
          ),
          (route) => false,
        );
      } else {
        String errorMessage = data['message'] ?? 'Registration failed.';

        if (data['errors'] != null) {
          final errors = data['errors'] as Map<String, dynamic>;
          final firstError = errors.values.first;

          if (firstError is List && firstError.isNotEmpty) {
            errorMessage = firstError.first.toString();
          }
        }

        showMessage(errorMessage);
      }
    } catch (e) {
      showMessage('Connection error: $e');
    } finally {
      if (mounted) {
        setState(() {
          isLoading = false;
        });
      }
    }
  }

  void showMessage(String message) {
    if (!mounted) return;

    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        content: Text(message),
        backgroundColor: DreamHomeColors.primary,
      ),
    );
  }

  Widget buildInputField({
    required TextEditingController controller,
    required String label,
    required IconData icon,
    TextInputType keyboardType = TextInputType.text,
    bool obscureText = false,
    Widget? suffixIcon,
  }) {
    return TextField(
      controller: controller,
      keyboardType: keyboardType,
      obscureText: obscureText,
      decoration: inputDecoration(
        label: label,
        icon: icon,
        suffixIcon: suffixIcon,
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: DreamHomeColors.accent,
      appBar: AppBar(
        backgroundColor: DreamHomeColors.primary,
        foregroundColor: Colors.white,
        title: const Text('Client Registration'),
        centerTitle: true,
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(22),
        child: Card(
          elevation: 8,
          color: Colors.white,
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(26),
          ),
          child: Padding(
            padding: const EdgeInsets.all(24),
            child: Column(
              children: [
                CircleAvatar(
                  radius: 38,
                  backgroundColor: DreamHomeColors.primary.withValues(alpha: 0.12),
                  child: const Icon(
                    Icons.person_add_alt_1_rounded,
                    size: 42,
                    color: DreamHomeColors.primary,
                  ),
                ),
                const SizedBox(height: 16),
                const Text(
                  'Create Account',
                  style: TextStyle(
                    fontSize: 28,
                    fontWeight: FontWeight.bold,
                    color: DreamHomeColors.textDark,
                  ),
                ),
                const SizedBox(height: 6),
                const Text(
                  'Register as a DreamHome client',
                  style: TextStyle(
                    color: DreamHomeColors.muted,
                    fontSize: 15,
                  ),
                ),
                const SizedBox(height: 24),
                buildInputField(
                  controller: firstNameController,
                  label: 'First Name',
                  icon: Icons.person_outline,
                ),
                const SizedBox(height: 14),
                buildInputField(
                  controller: lastNameController,
                  label: 'Last Name',
                  icon: Icons.person_outline,
                ),
                const SizedBox(height: 14),
                buildInputField(
                  controller: addressController,
                  label: 'Address',
                  icon: Icons.home_outlined,
                ),
                const SizedBox(height: 14),
                buildInputField(
                  controller: telephoneController,
                  label: 'Telephone Number',
                  icon: Icons.phone_outlined,
                  keyboardType: TextInputType.phone,
                ),
                const SizedBox(height: 14),
                buildInputField(
                  controller: emailController,
                  label: 'Email',
                  icon: Icons.email_outlined,
                  keyboardType: TextInputType.emailAddress,
                ),
                const SizedBox(height: 14),
                buildInputField(
                  controller: passwordController,
                  label: 'Password',
                  icon: Icons.lock_outline,
                  obscureText: hidePassword,
                  suffixIcon: IconButton(
                    icon: Icon(
                      hidePassword ? Icons.visibility_off : Icons.visibility,
                      color: DreamHomeColors.primary,
                    ),
                    onPressed: () {
                      setState(() {
                        hidePassword = !hidePassword;
                      });
                    },
                  ),
                ),
                const SizedBox(height: 6),
                const Align(
                  alignment: Alignment.centerLeft,
                  child: Text(
                    'Password must have at least 6 characters, 1 letter, 1 number, and 1 special character.',
                    style: TextStyle(
                      fontSize: 12,
                      color: DreamHomeColors.muted,
                    ),
                  ),
                ),
                const SizedBox(height: 14),
                DropdownButtonFormField<String>(
                  initialValue: selectedPreferType,
                  decoration: inputDecoration(
                    label: 'Preferred Type',
                    icon: Icons.apartment_outlined,
                  ),
                  items: propertyTypes.map((type) {
                    return DropdownMenuItem<String>(
                      value: type,
                      child: Text(
                        type[0].toUpperCase() + type.substring(1),
                      ),
                    );
                  }).toList(),
                  onChanged: (value) {
                    setState(() {
                      selectedPreferType = value;
                    });
                  },
                ),
                const SizedBox(height: 14),
                TextField(
                  controller: maxRentController,
                  keyboardType: TextInputType.number,
                  inputFormatters: [
                    FilteringTextInputFormatter.digitsOnly,
                  ],
                  onChanged: formatMaxRentInput,
                  decoration: inputDecoration(
                    label: 'Max Rent',
                    icon: Icons.payments_outlined,
                    suffixIcon: SizedBox(
                      width: 96,
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.end,
                        children: [
                          IconButton(
                            icon: const Icon(
                              Icons.keyboard_arrow_down_rounded,
                              color: DreamHomeColors.primary,
                            ),
                            onPressed: decreaseMaxRent,
                          ),
                          IconButton(
                            icon: const Icon(
                              Icons.keyboard_arrow_up_rounded,
                              color: DreamHomeColors.primary,
                            ),
                            onPressed: increaseMaxRent,
                          ),
                        ],
                      ),
                    ),
                  ),
                ),
                const SizedBox(height: 24),
                SizedBox(
                  width: double.infinity,
                  height: 52,
                  child: ElevatedButton(
                    onPressed: isLoading ? null : registerClient,
                    style: primaryButtonStyle(),
                    child: isLoading
                        ? const CircularProgressIndicator(
                            color: Colors.white,
                          )
                        : const Text(
                            'REGISTER',
                            style: TextStyle(
                              fontSize: 16,
                              fontWeight: FontWeight.bold,
                              letterSpacing: 1,
                            ),
                          ),
                  ),
                ),
                const SizedBox(height: 12),
                TextButton(
                  onPressed: () {
                    Navigator.pop(context);
                  },
                  child: const Text(
                    'Already have an account? Login',
                    style: TextStyle(
                      color: DreamHomeColors.primary,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}

class ClientHomeScreen extends StatelessWidget {
  const ClientHomeScreen({super.key});

  Future<String> getFirstName() async {
    final prefs = await SharedPreferences.getInstance();
    return prefs.getString('first_name') ?? 'Client';
  }

  Future<void> logout(BuildContext context) async {
    final prefs = await SharedPreferences.getInstance();
    await prefs.remove('token');
    await prefs.remove('first_name');
    await prefs.remove('client_id');
    await prefs.remove('max_rent');

    if (!context.mounted) return;

    Navigator.pushReplacement(
      context,
      MaterialPageRoute(
        builder: (context) => const LoginScreen(),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return FutureBuilder<String>(
      future: getFirstName(),
      builder: (context, snapshot) {
        final firstName = snapshot.data ?? 'Client';

        return Scaffold(
          backgroundColor: DreamHomeColors.accent,
          appBar: AppBar(
            backgroundColor: DreamHomeColors.primary,
            foregroundColor: Colors.white,
            title: const Text('DreamHome Client'),
            centerTitle: true,
            actions: [
              IconButton(
                onPressed: () => logout(context),
                icon: const Icon(Icons.logout),
              ),
            ],
          ),
          body: Padding(
            padding: const EdgeInsets.all(20),
            child: Column(
              children: [
                Container(
                  width: double.infinity,
                  padding: const EdgeInsets.all(24),
                  decoration: BoxDecoration(
                    color: DreamHomeColors.primary,
                    borderRadius: BorderRadius.circular(24),
                  ),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        'Welcome, $firstName!',
                        style: const TextStyle(
                          color: Colors.white,
                          fontSize: 26,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                      const SizedBox(height: 8),
                      const Text(
                        'Find your next rental home with DreamHome.',
                        style: TextStyle(
                          color: Colors.white70,
                          fontSize: 16,
                        ),
                      ),
                    ],
                  ),
                ),
                const SizedBox(height: 24),
                DashboardButton(
                  icon: Icons.apartment,
                  title: 'View Properties',
                  subtitle: 'Browse available rental properties',
                  onTap: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (context) => const PropertyScreen(),
                      ),
                    );
                  },
                ),
                const SizedBox(height: 16),
                DashboardButton(
                  icon: Icons.calendar_month,
                  title: 'My Viewings',
                  subtitle: 'Check your requested property viewings',
                  onTap: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (context) => const MyViewingsScreen(),
                      ),
                    );
                  },
                ),
              ],
            ),
          ),
        );
      },
    );
  }
}

class DashboardButton extends StatelessWidget {
  final IconData icon;
  final String title;
  final String subtitle;
  final VoidCallback onTap;

  const DashboardButton({
    super.key,
    required this.icon,
    required this.title,
    required this.subtitle,
    required this.onTap,
  });

  @override
  Widget build(BuildContext context) {
    return Card(
      elevation: 5,
      color: Colors.white,
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(18),
      ),
      child: ListTile(
        contentPadding: const EdgeInsets.all(18),
        leading: CircleAvatar(
          backgroundColor: DreamHomeColors.primary.withValues(alpha: 0.12),
          child: Icon(icon, color: DreamHomeColors.primary),
        ),
        title: Text(
          title,
          style: const TextStyle(
            fontWeight: FontWeight.bold,
            color: DreamHomeColors.textDark,
          ),
        ),
        subtitle: Text(
          subtitle,
          style: const TextStyle(color: DreamHomeColors.muted),
        ),
        trailing: const Icon(
          Icons.arrow_forward_ios,
          color: DreamHomeColors.primary,
        ),
        onTap: onTap,
      ),
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

  @override
  void initState() {
    super.initState();
    fetchProperties();
  }

  Future<void> fetchProperties() async {
    try {
      final response = await http.get(
        Uri.parse('${ApiConfig.baseUrl}/properties'),
        headers: {
          'Accept': 'application/json',
        },
      );

      if (response.statusCode == 200) {
        final prefs = await SharedPreferences.getInstance();
        final savedMaxRent = prefs.getString('max_rent') ?? '0';

        final clientMaxRent = double.tryParse(savedMaxRent) ?? 0;
        final allProperties = jsonDecode(response.body) as List<dynamic>;

        final filteredProperties = allProperties.where((property) {
          final rentText = property['monthly_rent']?.toString() ?? '0';
          final propertyRent = double.tryParse(rentText) ?? 0;

          return propertyRent <= clientMaxRent;
        }).toList();

        setState(() {
          properties = filteredProperties;
          isLoading = false;
        });
      } else {
        setState(() {
          isLoading = false;
        });
      }
    } catch (e) {
      setState(() {
        isLoading = false;
      });

      if (!mounted) return;

      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text('Error loading properties: $e'),
          backgroundColor: DreamHomeColors.primary,
        ),
      );
    }
  }

  Future<void> requestViewing(String propertyId) async {
    final prefs = await SharedPreferences.getInstance();
    final token = prefs.getString('token');

    if (token == null) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(
          content: Text('Please login first.'),
        ),
      );
      return;
    }

    try {
      final response = await http.post(
        Uri.parse('${ApiConfig.baseUrl}/viewings'),
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'Authorization': 'Bearer $token',
        },
        body: jsonEncode({
          'property_id': propertyId,
        }),
      );

      if (!mounted) return;

      if (response.statusCode == 200 || response.statusCode == 201) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            content: Text(
              'Viewing request submitted! Please wait for admin approval.',
            ),
          ),
        );
      } else {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text('Request failed: ${response.body}'),
            backgroundColor: DreamHomeColors.primary,
          ),
        );
      }
    } catch (e) {
      if (!mounted) return;

      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text('Error: $e'),
          backgroundColor: DreamHomeColors.primary,
        ),
      );
    }
  }

  String getValue(dynamic property, String key) {
    if (property == null || property[key] == null) return 'N/A';
    return property[key].toString();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: DreamHomeColors.accent,
      appBar: AppBar(
        backgroundColor: DreamHomeColors.primary,
        foregroundColor: Colors.white,
        title: const Text('Available Properties'),
        centerTitle: true,
      ),
      body: isLoading
          ? const Center(
              child: CircularProgressIndicator(
                color: DreamHomeColors.primary,
              ),
            )
          : properties.isEmpty
              ? const Center(
                  child: Text(
                    'No properties available within your max rent.',
                    style: TextStyle(fontSize: 18),
                  ),
                )
              : ListView.builder(
                  padding: const EdgeInsets.all(12),
                  itemCount: properties.length,
                  itemBuilder: (context, index) {
                    final property = properties[index];
                    final propertyId = getValue(property, 'property_id');

                    return Card(
                      margin: const EdgeInsets.only(bottom: 14),
                      elevation: 5,
                      color: Colors.white,
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(18),
                      ),
                      child: Padding(
                        padding: const EdgeInsets.all(18),
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Text(
                              propertyId,
                              style: const TextStyle(
                                fontSize: 20,
                                fontWeight: FontWeight.bold,
                                color: DreamHomeColors.textDark,
                              ),
                            ),
                            const SizedBox(height: 8),
                            Text('Type: ${getValue(property, 'type')}'),
                            Text('City: ${getValue(property, 'city')}'),
                            Text('Rooms: ${getValue(property, 'rooms')}'),
                            Text(
                              'Rent: ₱${getValue(property, 'monthly_rent')}',
                            ),
                            Text('Status: ${getValue(property, 'status')}'),
                            const SizedBox(height: 14),
                            SizedBox(
                              width: double.infinity,
                              child: ElevatedButton.icon(
                                onPressed: () {
                                  requestViewing(propertyId);
                                },
                                icon: const Icon(Icons.calendar_month),
                                label: const Text('Request Viewing'),
                                style: primaryButtonStyle(),
                              ),
                            ),
                          ],
                        ),
                      ),
                    );
                  },
                ),
    );
  }
}

class MyViewingsScreen extends StatefulWidget {
  const MyViewingsScreen({super.key});

  @override
  State<MyViewingsScreen> createState() => _MyViewingsScreenState();
}

class _MyViewingsScreenState extends State<MyViewingsScreen> {
  List<dynamic> viewings = [];
  bool isLoading = true;

  @override
  void initState() {
    super.initState();
    fetchMyViewings();
  }

  Future<void> fetchMyViewings() async {
    final prefs = await SharedPreferences.getInstance();
    final token = prefs.getString('token');

    if (token == null) {
      setState(() {
        isLoading = false;
      });

      if (!mounted) return;

      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(
          content: Text('Please login first.'),
        ),
      );

      return;
    }

    try {
      final response = await http.get(
        Uri.parse('${ApiConfig.baseUrl}/my-viewings'),
        headers: {
          'Accept': 'application/json',
          'Authorization': 'Bearer $token',
        },
      );

      final data = jsonDecode(response.body);

      if (response.statusCode == 200) {
        setState(() {
          viewings = data['data'] ?? [];
          isLoading = false;
        });
      } else {
        setState(() {
          isLoading = false;
        });

        if (!mounted) return;

        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text(data['message'] ?? 'Failed to load viewings.'),
            backgroundColor: DreamHomeColors.primary,
          ),
        );
      }
    } catch (e) {
      setState(() {
        isLoading = false;
      });

      if (!mounted) return;

      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text('Error loading viewings: $e'),
          backgroundColor: DreamHomeColors.primary,
        ),
      );
    }
  }

  String getValue(dynamic data, String key) {
    if (data == null || data[key] == null) return 'N/A';
    return data[key].toString();
  }

  String getViewingDate(dynamic viewing) {
    if (viewing == null || viewing['view_date'] == null) {
      return 'Pending schedule';
    }

    return viewing['view_date'].toString();
  }

  String getStaffName(dynamic staff) {
    if (staff == null) {
      return 'Pending assignment';
    }

    final firstName = staff['first_name']?.toString() ?? '';
    final lastName = staff['last_name']?.toString() ?? '';
    final fullName = '$firstName $lastName'.trim();

    if (fullName.isEmpty) {
      return 'Pending assignment';
    }

    return fullName;
  }

  Color getStatusColor(String status) {
    switch (status.toLowerCase()) {
      case 'approved':
        return Colors.green;
      case 'completed':
        return Colors.blue;
      case 'cancelled':
        return Colors.red;
      default:
        return DreamHomeColors.primary;
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: DreamHomeColors.accent,
      appBar: AppBar(
        backgroundColor: DreamHomeColors.primary,
        foregroundColor: Colors.white,
        title: const Text('My Viewings'),
        centerTitle: true,
      ),
      body: isLoading
          ? const Center(
              child: CircularProgressIndicator(
                color: DreamHomeColors.primary,
              ),
            )
          : viewings.isEmpty
              ? const Center(
                  child: Text(
                    'No viewing requests yet.',
                    style: TextStyle(
                      fontSize: 18,
                      color: DreamHomeColors.textDark,
                    ),
                  ),
                )
              : RefreshIndicator(
                  color: DreamHomeColors.primary,
                  onRefresh: fetchMyViewings,
                  child: ListView.builder(
                    padding: const EdgeInsets.all(12),
                    itemCount: viewings.length,
                    itemBuilder: (context, index) {
                      final viewing = viewings[index];
                      final property = viewing['property'];
                      final staff = viewing['staff'];
                      final status = getValue(viewing, 'status');

                      return Card(
                        elevation: 5,
                        color: Colors.white,
                        margin: const EdgeInsets.only(bottom: 14),
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(18),
                        ),
                        child: Padding(
                          padding: const EdgeInsets.all(18),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Row(
                                children: [
                                  CircleAvatar(
                                    backgroundColor: DreamHomeColors.primary
                                        .withValues(alpha: 0.12),
                                    child: const Icon(
                                      Icons.calendar_month,
                                      color: DreamHomeColors.primary,
                                    ),
                                  ),
                                  const SizedBox(width: 12),
                                  const Expanded(
                                    child: Text(
                                      'Viewing Request',
                                      style: TextStyle(
                                        fontSize: 20,
                                        fontWeight: FontWeight.bold,
                                        color: DreamHomeColors.textDark,
                                      ),
                                    ),
                                  ),
                                ],
                              ),
                              const SizedBox(height: 14),
                              Container(
                                padding: const EdgeInsets.symmetric(
                                  horizontal: 12,
                                  vertical: 6,
                                ),
                                decoration: BoxDecoration(
                                  color:
                                      getStatusColor(status).withValues(alpha: 0.12),
                                  borderRadius: BorderRadius.circular(20),
                                ),
                                child: Text(
                                  'Status: $status',
                                  style: TextStyle(
                                    color: getStatusColor(status),
                                    fontWeight: FontWeight.bold,
                                  ),
                                ),
                              ),
                              const SizedBox(height: 14),
                              Text(
                                'Property ID: ${getValue(viewing, 'property_id')}',
                              ),
                              Text(
                                'Viewing Date: ${getViewingDate(viewing)}',
                              ),
                              const Divider(height: 24),
                              Text(
                                'Property Type: ${getValue(property, 'type')}',
                              ),
                              Text(
                                'City: ${getValue(property, 'city')}',
                              ),
                              Text(
                                'Monthly Rent: ₱${getValue(property, 'monthly_rent')}',
                              ),
                              const Divider(height: 24),
                              Text(
                                'Staff Assigned: ${getStaffName(staff)}',
                              ),
                            ],
                          ),
                        ),
                      );
                    },
                  ),
                ),
    );
  }
}