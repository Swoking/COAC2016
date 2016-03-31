#include "addclass.h"

AddClass::AddClass(COAC *fen, QWidget *parent) :
    QDialog(parent),
    fenetre(fen)
{
    setupUi(this);

    for( int i = QDateTime::currentDateTime().date().year() - 1; i >= 2000; i--) {
        cmbDebut->addItem( QString::number(i), QVariant(i) );
    }

    for( int i = QDateTime::currentDateTime().date().year(); i >= 2000; i--) {
        cmbFin->addItem( QString::number(i), QVariant(i) );
    }

    connect(buttonBox, SIGNAL(accepted()), this, SLOT(onAcceptedAddClasse()));
}

void AddClass::onAcceptedAddClasse() {
    qDebug() << "AddClass::onAcceptedAddCarte() > Ok";

    Database db;
    if(db.getDB().isOpen()) {
        QSqlQuery query;
        query.prepare("INSERT INTO Promo(Entree, Sortie, Nom, Filiere) "
                      "VALUE(?, ?, ?, ?)");
        query.addBindValue(cmbDebut->currentData());
        query.addBindValue(cmbFin->currentData());
        query.addBindValue(ledtNom->text());
        query.addBindValue(ledtFiliere->text());
        query.exec();
    }
}
