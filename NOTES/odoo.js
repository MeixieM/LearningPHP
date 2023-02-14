from odoo import models, fields

class MyModel(models.Model):
    _name = 'my_module.my_model'
    _description = 'My custom model'

    name = fields.Char(string='Name', required=True)
    value = fields.Integer(string='Value')
    description = fields.Text(string='Description')


    <odoo>
    <data>
        <record id="my_model_form_view" model="ir.ui.view">
            <field name="name">my_module.my_model.form</field>
            <field name="model">my_module.my_model</field>
            <field name="arch" type="xml">
                <form string="My Model">
                    <sheet>
                        <group>
                            <field name="name"/>
                            <field name="value"/>
                            <field name="description"/>
                        </group>
                    </sheet>
                </form>
            </field>
        </record>

        <record id="my_model_tree_view" model="ir.ui.view">
            <field name="name">my_module.my_model.tree</field>
            <field name="model">my_module.my_model</field>
            <field name="arch" type="xml">
                <tree string="My Model">
                    <field name="name"/>
                    <field name="value"/>
                </tree>
            </field>
        </record>
    </data>
</odoo>



'name': 'My Module',
'version': '1.0',
'category': 'Uncategorized',
'summary': 'A brief description of my module',
'description': """
    A longer description of my module.
""",
'author': 'My Name',
'website': 'https://www.example.com',
'depends': ['base'],
'data': [
    'views/my_model_views.xml',
],
'installable': True,
'application': True,
'auto_install': False,
}

