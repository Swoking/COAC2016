#ifndef ADDCARTE_H
#define ADDCARTE_H

#include "myadd.h"
#include <QLineEdit>
#include <QComboBox>
#include <QPushButton>

class COAC;
class Database;
class ListEleve;

class AddCarte : public MyAdd
{
    Q_OBJECT
private:
    QLineEdit *ledtNum;
    QComboBox *cmbEtat;
    QPushButton *pbuEleve;

    int id;
    ListEleve *eleveList;

protected slots:
    virtual void envoyer();

private slots:
    void showEleveList(bool i);

public slots:
    void onDoubleClickListEleve(QModelIndex);

public:
    explicit AddCarte(COAC *, Database *);
};

#endif // ADDCARTE_H
