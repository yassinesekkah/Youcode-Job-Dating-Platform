{% extends "layouts/back.twig" %}

{% block content %}

<h1 class="text-xl font-semibold mb-6">
    Applications
</h1>

<table class="min-w-full bg-white rounded shadow text-sm">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-3">Student</th>
            <th class="p-3">Email</th>
            <th class="p-3">Motivation</th>
            <th class="p-3">CV</th>
            <th class="p-3">Status</th>
            <th class="p-3">Date</th>
        </tr>
    </thead>

    <tbody>
        {% for app in applications %}
        <tr class="border-t">
            <td class="p-3">{{ app.name }}</td>
            <td class="p-3">{{ app.email }}</td>
            <td class="p-3 text-xs">{{ app.motivation }}</td>
            <td class="p-3">
                {% if app.cv_path %}
                    <a href="{{ app.cv_path }}" target="_blank" class="text-indigo-600">
                        Download
                    </a>
                {% else %}
                    —
                {% endif %}
            </td>
            <td class="p-3">
                <form method="POST" action="/admin/applications/status">
                    <input type="hidden" name="csrf_token" value="{{ csrf_token }}">
                    <input type="hidden" name="id" value="{{ app.id }}">

                    <select name="status" onchange="this.form.submit()"
                        class="border rounded text-xs">
                        <option value="pending" {{ app.status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="accepted" {{ app.status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                        <option value="rejected" {{ app.status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </form>
            </td>
            <td class="p-3 text-xs">{{ app.created_at }}</td>
        </tr>
        {% else %}
        <tr>
            <td colspan="6" class="p-6 text-center text-gray-500">
                No applications found
            </td>
        </tr>
        {% endfor %}
    </tbody>
</table>

{% endblock %}
