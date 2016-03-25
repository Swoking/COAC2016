#include "addsalle.h"
#include <QLineEdit>
#include <QSqlQuery>
#include <QDebug>

AddSalle::AddSalle(COAC *parentFenetre, Database *database) :
    MyAdd(parentFenetre, database)
{
    this->setWindowTitle("Ajouter une salle");

    ledtNom = new QLineEdit;

    myLayout->addRow("&Nom de la salle :", ledtNom);
    setLayout(myLayout);

    connect(myButtonBox, SIGNAL(accepted()), this, SLOT(envoyer()));
}

void AddSalle::envoyer(){
    //if(db->getDB().isOpen()){
        QSqlQuery queryPromos;
        queryPromos.prepare("INSERT INTO Salle VALUES(NULL, ?)");
        queryPromos.addBindValue(ledtNom->text());
        queryPromos.exec();
        qDebug() << "AddSalle::envoyer() > La classe a été ajouter.";
    //} else {
        qDebug() << "AddSalle::envoyer() > Erreur lors de l'ajout de la casse.";
    //}
}
